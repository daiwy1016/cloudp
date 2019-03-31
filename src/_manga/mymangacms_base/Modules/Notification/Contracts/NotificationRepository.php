<?php

namespace Modules\Notification\Contracts;

/**
 * Interface NotificationRepository
 * @package Modules\Notification\Repositories
 */
interface NotificationRepository
{
    /**
     * Create a resource
     * @param  $data
     * @return $model
     */
    public function create($data);

    /**
     * Insert a resource
     * @param  $data
     * @return $model
     */
    public function insert($data);
    
    /**
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function latestForUser($userId);

    /**
     * Mark the given notification id as "read"
     * @param int $notificationId
     * @return bool
     */
    public function markNotificationAsRead($notificationId, $userId);

    /**
     * Get all the notifications for the given user id
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function allForUser($userId);

    /**
     * Get all the unread notifications for the given user id
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function allUnreadForUser($userId);

    /**
     * Get all the read notifications for the given user id
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function allReadForUser($userId);

    /**
     * Delete all the notifications for the given user
     * @param int $userId
     * @return bool
     */
    public function deleteAllForUser($userId);

    /**
     * Mark all the notifications for the given user as read
     * @param int $userId
     * @return bool
     */
    public function markAllAsReadForUser($userId);
    
    public function saveSettings($userId, $data);
}