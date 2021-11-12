<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Business extends Model
{
	use HasFactory;

	protected $table = 'business';
	public $timestamps = true;

	public function users()
	{
		return $this->hasMany(User::class);
	}

	public function contacts()
	{
		return $this->hasMany(Contact::class);
	}
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */

	protected $fillable = [
		'name', 'domain'
	];
}
