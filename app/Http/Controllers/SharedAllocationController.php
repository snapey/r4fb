<?php

namespace App\Http\Controllers;

use App\Allocation;
use Illuminate\Http\Request;

class SharedAllocationController extends Controller
{
    public function show(Allocation $allocation)
    {
        // putting the allocation number into session allows the signed URL to be dropped
        session()->put('shared-authenticated', $allocation->id);

        return redirect()->route('allocation.shared.authenticated',$allocation);
    }

    public function authenticatedShow(Allocation $allocation)
    {
        abort_unless(session('shared-authenticated') == $allocation->id,403);

        if($allocation->status != Allocation::SHARED) {
            return view('allocations.notshared')->withAllocation($allocation);
        }

        return view('allocations.shared')->withAllocation($allocation);
    }

}
