<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Zizaco\Entrust\HasRole;
use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\ConfideUserInterface;

/**
 * User Model Class
 * 
 * PHP version 5.4
 *
 * @category PHP
 * @package  Controller
 * @author   cyberziko <cyberziko@gmail.com>
 * @license  commercial http://getcyberworks.com/
 * @link     http://getcyberworks.com/
 */
class User extends Eloquent implements UserInterface, RemindableInterface,
        ConfideUserInterface
{

    use ConfideUser;
    use HasRole;

    public $fillable = ['name', 'username', 'password', 'email', 'confirmed'];
	
    public function manga()
    {
        return $this->hasMany('Manga')->orderBy('slug', 'desc');
    }
	
	public function chapters()
    {
        return $this->hasMany('Chapter')->orderBy('slug', 'desc');
    }
}
