<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	protected $table = 'contacts';
	public $timestamps = true;

	public function business()
	{
		return $this->belongsTo(Business::class);
	}
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'firstName', 'lastName', 'email', 'type', 'phone', 'occupation', 'company', 'address'
	];
}
