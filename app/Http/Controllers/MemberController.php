<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Repositories\MemberRepository;
use Exception;
use Illuminate\Http\Request;

class MemberController extends Controller
{
  
    protected $repository;
  
    public function __construct(MemberRepository $repository)
    {
        $this->repository = $repository;
    }
  
    /**
     * get list of all the posts.
     *
     * @param $request: Illuminate\Http\Request
     * @return json response
     */
    public function index(Request $request)
    {
        $items = $this->repository->paginate($request);
        return response()->json(['items' => $items]);
    }
  
    /**
     * store post data to database table.
     *
     * @param $request: App\Http\Requests\CreatePostRequest
     * @return json response
     */
    public function store(CreateMemberRequest $request)
    {
        try {
            $item = $this->repository->store($request);
            return response()->json(['item' => $item]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getStatus());
        }
    }
  
    /**
     * update post data to database table.
     *
     * @param $request: App\Http\Requests\UpdatePostRequest
     * @return json response
     */
    public function update($id, UpdateMemberRequest $request)
    {
        try {
            $item = $this->repository->update($id, $request);
            return response()->json(['item' => $item]);
        } catch (Exception $e) {
           return response()->json(['message' => $e->getMessage()], $e->getStatus());
        }
    }
  
    /**
     * get single item by id.
     * 
     * @param integer $id: integer post id.
     * @return json response.
     */
    public function show($id)
    {
        try {
            $item = $this->repository->show($id);
            return response()->json(['item' => $item]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getStatus());
        }
    }
 
    /**
     * delete post by id.
     * 
     * @param integer $id: integer post id.
     * @return json response.
     */
    public function delete($id)
    {
        try {
            $this->repository->delete($id);
            return response()->json([], 204);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getStatus());
        }
    }
}