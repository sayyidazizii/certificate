<?php
namespace App\Http\Controllers;

use App\Models\SystemMenu;
use App\Models\SystemMenuMapping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function index()
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Get the user's group ID from the system_user table
        $userGroupId = $user->user_group_id; // Assuming the user group ID is in the system_user table

        $menus = SystemMenu::whereHas('mappings', function($query) use ($userGroupId) {
            // Filter by user group ID in the system_user table
            $query->whereHas('userGroup', function($subQuery) use ($userGroupId) {
                $subQuery->where('user_group_id', $userGroupId);
            });
        })
        ->with(['children' => function($query) use ($userGroupId) {
            $query->whereHas('mappings', function($subQuery) use ($userGroupId) {
                $subQuery->whereHas('userGroup', function($subSubQuery) use ($userGroupId) {
                    $subSubQuery->where('user_group_id', $userGroupId);
                });
            });
        }])
        ->where('parent_id','=','#') // Only top-level menus
        ->get();
        echo json_encode($menus);
        exit;
        // Return the view with the hierarchical menu
        // return view('menu.index', compact('menus'));
    }
}
