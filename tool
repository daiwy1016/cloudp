#! /bin/bash

FLAG_AWS_LOGIN=0
FLAG_BUILD=0
FLAG_PROJECT=0
FLAG_RUN=0
FLAG_PUSH=0

while [[ "$#" > 0 ]];
do
    case $1 in
        -a|--aws-login)
            FLAG_AWS_LOGIN=1
            ;;

        -b|--build)
            FLAG_BUILD=1
            ;;

        -p|--project)
            FLAG_PROJECT="$2"
            shift
            ;;

        -r|--run)
            FLAG_RUN=1
            ;;

        -u|--push)
            FLAG_PUSH=1
            ;;
    esac
    shift
done

if [[ $FLAG_PROJECT == 0 ]];
then
    read -p 'Project: ' FLAG_PROJECT
fi

docker image prune -f 1>/dev/null 2>/dev/null

if [[ $FLAG_AWS_LOGIN == 1 ]];
then
    aws configure
    eval $(aws ecr get-login --no-include-email )
fi

if [[ $FLAG_BUILD == 1 ]];
then
    docker build --file Dockerfile --tag $FLAG_PROJECT .
fi

if [[ $FLAG_PUSH == 1 ]];
then
    docker stop $FLAG_PROJECT
    AWS_ACCOUNT_ID=$( aws sts get-caller-identity --output text --query 'Account' )
    docker images | grep amazonaws | awk '{print $3}' | xargs docker rmi
    NEW_TAG=$( docker images $FLAG_PROJECT --format "{{.ID}}" )
    docker tag $FLAG_PROJECT:latest $AWS_ACCOUNT_ID.dkr.ecr.us-east-1.amazonaws.com/$FLAG_PROJECT:$NEW_TAG
    docker push $AWS_ACCOUNT_ID.dkr.ecr.us-east-1.amazonaws.com/$FLAG_PROJECT
    echo Tag: $NEW_TAG
fi

if [[ $FLAG_RUN == 1 ]];
then
    docker stop $FLAG_PROJECT
    docker run --detach --interactive --publish 80:80 --name $FLAG_PROJECT --rm --tty $FLAG_PROJECT:latest
fi
