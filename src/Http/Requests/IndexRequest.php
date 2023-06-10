<?php


namespace Stepanenko3\NovaFilemanager\Http\Requests;

use Stepanenko3\NovaFilemanager\Rules\DiskExistsRule;
use Stepanenko3\NovaFilemanager\Rules\PathExistsInDiskRule;

/**
 * @property-read ?string $disk
 * @property-read string $path
 * @property-read ?int $page
 * @property-read ?int $perPage
 * @property-read ?string $search
 * @property-read ?string $sort
 * @property-read ?string $filterByDate
 */
class IndexRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'disk' => ['sometimes', 'string', new DiskExistsRule()],
            'path' => ['sometimes', 'string', new PathExistsInDiskRule($this->get('disk'))],
            'page' => ['sometimes', 'numeric', 'min:1'],
            'perPage' => ['sometimes', 'numeric', 'min:1'],
            'search' => ['nullable', 'string'],
            'filterByDate' => ['nullable', 'string'],
            'sort' => ['nullable', 'string', 'in:date,date-desc,name,name-desc,size,size-desc'],
        ];
    }
}
