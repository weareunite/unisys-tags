<?php

namespace Unite\Tags\Http\Controllers;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Unite\Tags\Http\Requests\StoreRequest;
use Unite\Tags\Tag;
use Unite\UnisysApi\Http\Controllers\Controller;
use Unite\Tags\Http\Requests\UpdateRequest;
use Unite\Tags\Http\Resources\TagResource;
use Unite\Tags\TagRepository;
use Unite\UnisysApi\Http\Resources\Resource;
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

        $this->setResourceClass(TagResource::class);

        $this->setResponse();

        $this->middleware('cache')->only(['list', 'show']);
    }

    /**
     * List
     *
     * @param QueryBuilderRequest $request
     *
     * @return AnonymousResourceCollection|Resource[]
     */
    public function list(QueryBuilderRequest $request)
    {
        $object = QueryBuilder::for($this->resource, $request)->paginate();

        return $this->response->collection($object);
    }

    /**
     * Show
     *
     * @param Tag $model
     *
     * @return Resource
     */
    public function show(Tag $model)
    {
        return $this->response->resource($model);
    }

    /**
     * Create
     *
     * @param StoreRequest $request
     *
     * @return Resource
     */
    public function create(StoreRequest $request)
    {
        $object = $this->repository->create( $request->all() );

        \Cache::tags('response')->flush();

        return $this->response->resource($object);
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

        \Cache::tags('response')->flush();

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

        \Cache::tags('response')->flush();

        return $this->successJsonResponse();
    }
}