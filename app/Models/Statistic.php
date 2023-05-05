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

	public function scopeFilter(object $query, array $filters): void
	{
		$locale = app()->getLocale();

		$query->when($filters['search'] ?? false, function (object $query, string $search) use ($locale) {
			$search = ucfirst(strtolower($search));
			$query->where(function (object $query) use ($search, $locale) {
				$query->where("name->$locale", 'LIKE', "%$search%");
			});
		});

		$query->when($filters['column'] ?? false, function (object $query, string $column) use ($filters) {
			$order = $filters['order'] ?? 'asc';
			$query->orderBy($column, $order);
		});
	}
}
