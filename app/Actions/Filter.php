<?php

namespace App\Actions;
 
use Illuminate\Http\Request;
 
class Filter
{
    public function handle($repository, Request $request, $relationships)
    {
        if($request->has('related_attributes')) {
            foreach($relationships as $relationship) {
                $related_attributes = $relationship . ':id,' . $request->related_attributes;
                $repository->selectRelatedAttributes($related_attributes);
            }
        } else {
            $repository->selectRelatedAttributes($relationships);
        }

        if($request->has('filter')) {
            $repository->filter($request->filter);
        }

        if($request->has('columns')) {
            $repository->selectAttributes($request->columns);
        }

        return $repository->getResult();
    }
}