<?php

namespace Unite\Tags\Http\Controllers;

use Unite\UnisysApi\Http\Controllers\Controller;
use Unite\Tags\Http\Requests\UpdateRequest;
use Unite\Tags\Http\Resources\TagResource;
use Unite\Tags\TagRepository;

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
     */
    public function index()
    {
        $list = $this->repository->paginate(1000);

        return TagResource::collection($list);
    }

    /**
     * Show
     *
     * @param $id
     * @return \Unite\Tags\Http\Resources\TagResource
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
     * @param \Unite\Tags\Http\Requests\UpdateRequest $request
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