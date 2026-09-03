<?php

namespace App\Services\ProjectControl;

use App\Models\Project\Projects;
use App\Models\ProjectControl\Boq;
use Illuminate\Database\Eloquent\Builder;

class ProjectControlBoqService
{
    public function getFormData(?string $category = null)
    {

        $projectQuery = Projects::query()
            ->select('id', 'project_name', 'category', 'isMultipleArea')
            ->where(function ($query) {
                $query->where('isMultipleArea', true)
                    ->orWhere(function ($query) {
                        $query->where('isMultipleArea', false)
                            ->whereDoesntHave('boqs');
                    });
            });

        $categories = (clone $projectQuery)
            ->whereNotNull('category')
            ->pluck('category')
            ->unique()
            ->values();

        $projects = $projectQuery->when($category, function ($query, $cat) {
            return $query->where('category', $cat);
        })->get()->values();

        return [
            'categories' => $categories,
            'projects' => $projects,
        ];

    }

    public function getBoqs()
    {
        return Boq::query()->join('projects', 'boqs.project_id', '=', 'projects.id')
            ->select(
                'projects.project_number as project_number',
                'projects.area as project_area',
                'projects.project_name as project_name',
                'boqs.id',
                'boqs.detailed_area',
                'boqs.isMultipleCustomer'
            )->get();

    }

    public function create(array $data)
    {
        return Boq::query()->create($data);

    }

    public function delete(int $id)
    {
        return Boq::query()->find($id)->delete();
    }

}
