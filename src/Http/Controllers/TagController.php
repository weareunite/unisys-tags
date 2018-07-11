<?php

namespace Unite\Tags\Http\Controllers;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Unite\Tags\Tag;
use Unite\UnisysApi\Http\Controllers\Controller;
use Unite\Tags\Http\Requests\UpdateRequest;
use Unite\Tags\Http\Resources\TagResource;
use Unite\Tags\TagRepository;
use Unite\UnisysApi\Http\Requests\QueryRequest;

/**
 * @resource Tags
 *
 * Tag handler
 */
class TagController extends Controller
{
    protected $repository;

    public function __construct(TagRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * List
     *
     * @param QueryRequest $request
     *
     * @return AnonymousResourceCollection|TagResource[]
     */
    public function list(QueryRequest $request)
    {
        $object = $this->repository->filterByRequest($request);

        return TagResource::collection($object);
    }

    /**
     * Show
     *
     * @param Tag $model
     *
     * @return TagResource
     */
    public function show(Tag $model)
    {
        return new TagResource($model);
    }

    /**
     * Update
     *
     * @param Tag $model
     * @param UpdateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Tag $model, UpdateRequest $request)
    {
        $model->update( $request->all() );

        return $this->successJsonResponse();
    }

    /**
     * Delete
     *
     * @param Tag $model
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Tag $model)
    {
        $model->delete();

        return $this->successJsonResponse();
    }
}