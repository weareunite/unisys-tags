<?php

namespace Unite\Tags\Http\Controllers;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
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
     * @param $id
     * @return TagResource
     */
    public function show($id)
    {
        if(!$object = $this->repository->find($id)) {
            abort(404);
        }

        return new TagResource($object);
    }

    /**
     * Update
     *
     * @param $id
     * @param UpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, UpdateRequest $request)
    {
        if(!$object = $this->repository->find($id)) {
            abort(404);
        }

        $data = $request->all();

        $object->update($data);

        return $this->successJsonResponse();
    }

    /**
     * Delete
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $this->repository->delete($id);

        return $this->successJsonResponse();
    }
}