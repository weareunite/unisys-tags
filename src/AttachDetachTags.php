<?php

namespace Unite\Tags;

use Unite\Tags\Http\Requests\AttachRequest;
use Unite\Tags\Http\Requests\DetachRequest;
use Unite\Tags\Http\Requests\MassAttachRequest;

trait AttachDetachTags
{
    /**
     * Attach Tags
     *
     * @param HasTagsInterface $model
     * @param AttachRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function attachTags(HasTagsInterface $model, AttachRequest $request)
    {
        $data = $request->only(['tag_names']);

        $model->attachTags($data['tag_names']);

        return $this->successJsonResponse();
    }

    /**
     * Mass Attach Tags
     *
     * @param MassAttachRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function massAttachTags(MassAttachRequest $request)
    {
        $data = $request->only(['ids', 'tag_names']);

        foreach ($data['ids'] as $model_id) {
            if($object = $this->repository->find($model_id)) {
                $object->attachTags($data['tag_names']);
            }
        }

        return $this->successJsonResponse();
    }

    /**
     * Detach tags
     *
     * @param HasTagsInterface $model
     * @param DetachRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function detachTags(HasTagsInterface $model, DetachRequest $request)
    {
        $data = $request->only('tag_names');

        $model->detachTags($data['tag_names']);

        return $this->successJsonResponse();
    }
}
