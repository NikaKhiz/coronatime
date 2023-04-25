<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Statistic extends Model
{
	use HasFactory,HasTranslations;

	protected $guarded = ['id'];

	protected $translatable = ['name'];

	public function scopeFilter($query, $filters)
	{
		$locale = app()->getLocale();

		$query->when($filters['search'] ?? false, function ($query, $search) use ($locale) {
			$search = ucfirst(strtolower($search));
			$query->where(function ($query) use ($search, $locale) {
				$query->where("name->$locale", 'LIKE', "%$search%");
			});
		});

		$query->when($filters['column'] ?? false, function ($query, $column) use ($filters) {
			$order = $filters['order'] ?? 'asc';
			$query->orderBy($column, $order);
		});
	}
}
