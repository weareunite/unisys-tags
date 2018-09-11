<?php

namespace Unite\Tags\Http\Controllers;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Unite\Tags\Http\Requests\StoreRequest;
use Unite\Tags\Tag;
use Unite\UnisysApi\Http\Controllers\Controller;
use Unite\Tags\Http\Requests\UpdateRequest;
use Unite\Tags\Http\Resources\TagResource;
use Unite\Tags\TagRepository;
use Unite\UnisysApi\QueryBuilder\QueryBuilder;
use Unite\UnisysApi\QueryBuilder\QueryBuilderRequest;

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
     * @param QueryBuilderRequest $request
     *
     * @return AnonymousResourceCollection|TagResource[]
     */
    public function list(QueryBuilderRequest $request)
    {
        $object = QueryBuilder::for($this->repository, $request)->paginate();

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
     * Create
     *
     * @param StoreRequest $request
     *
     * @return TagResource
     */
    public function create(StoreRequest $request)
    {
        $object = $this->repository->create( $request->all() );

        return new TagResource($object);
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
        try {
            $model->delete();
        } catch(\Exception $e) {
            abort(409, 'Cannot delete record');
        }

        return $this->successJsonResponse();
    }
}