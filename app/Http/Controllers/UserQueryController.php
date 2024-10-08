<?php

namespace App\Http\Controllers;

use App\Models\UserQuery;
use Illuminate\Http\Request;

class UserQueryController extends Controller
{
    //
    public function query()
    {
        $query = UserQuery::getUserQuery();
        //orderBy('id', 'desc')->get();
        $header_title = 'User Query';
        return view('back_end.user_query.index', compact('query', 'header_title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:user_queries,name',
            'email' => 'required|email|unique:user_queries,email', // Ensure email is unique
            'message' => 'required',
        ]);

        try {
            $query = new UserQuery();
            $query->name = $request->name;
            $query->email = $request->email;
            $query->message = $request->message;
            $query->save();

            return redirect()->back()->with('success', __('label.queryCreatedSuccess'));
        } catch (\Exception $e) {
            
            return redirect()->back()->with('error', __('label.queryCreatedFail') . $e->getMessage());
          
        }
    }

    public function markAsRead($id)
    {
        $query = UserQuery::findOrFail($id);

        if (!empty($query)) {
            $query->seen = 1;
            $query->save();

            return redirect('/queries')->with('success', 'Query marked as read');
        }

        return redirect('/queries')->with('error', 'Query not found');
    }

    public function delete($id)
    {
        try {
            $query = UserQuery::findOrFail($id);
            $query->delete();

            return redirect('/queries')->with('success', __('label.queryDeleteSuccess'));

        } catch (\Exception $e) {
            return redirect('/queries')->with('success', __('label.queryDeleteError'));
        }
        return redirect('/queries');
    }
}
