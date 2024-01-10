<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Yajra\DataTables\DataTables;
use Illuminate\Support\Carbon;

class OrderProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $orders = "";
            $status = $request->has('status_filter') ? $request->status_filter : null;
            $startDate = null;
            $endDate = null;


            $query = Order::query();

            if ($request->has('date_filter')) {
                $dateFilter = $request->date_filter;

                switch ($dateFilter) {
                    case 'today':
                        $startDate = Carbon::today();
                        $endDate = Carbon::tomorrow();
                        break;
                    case 'yesterday':
                        $startDate = Carbon::yesterday();
                        $endDate = Carbon::today();
                        break;
                    case 'this_week':
                        $startDate = Carbon::now()->startOfWeek();
                        $endDate = Carbon::now()->endOfWeek();
                        break;
                    case 'last_week':
                        $startDate = Carbon::now()->subWeek()->startOfWeek();
                        $endDate = Carbon::now()->subWeek()->endOfWeek();
                        break;
                    case 'this_month':
                        $startDate = Carbon::now()->month();
                        break;
                    case 'last_month':
                        $startDate = Carbon::now()->subMonth();
                        $endDate = Carbon::now()->month();
                        break;
                    case 'this_year':
                        $startDate = Carbon::now()->startOfYear();
                        $endDate = Carbon::now()->endOfYear();
                        break;
                    case 'last_year':
                        $startDate = Carbon::now()->subYear()->startOfYear();
                        $endDate = Carbon::now()->subYear()->endOfYear();
                        break;
                }
            }

            if ($startDate && $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }

            if ($request->payment_type) {
                $query->where('payment_type', $request->payment_type);
            }

            $searchTerm = $request->search;
            if(!empty($request->search)){
                $query->where(function ($subquery) use ($searchTerm) {
                    $subquery->where('order_id', 'like', '%' . $searchTerm . '%')
                        ->orWhere('customer_name', 'like', '%' . $searchTerm . '%');
                });
            }



            if ($status !== null) {
                $query->where('status', $status);
            }

            $orders = $query->orderBy('id','DESC')->get();






            return DataTables::of($orders)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    $now = Carbon::parse($row->created_at);
                    return $now->toFormattedDateString();
                })
                ->editColumn('status', function ($row) {
                    if ($row->status == 0) {
                        return '<span class="status_processing"> <i
                      class="fa fa-refresh"></i> Processing</span>';
                    } elseif ($row->status == 1) {
                        return '<span class="status_draft"> <i
                      class="fa fa-pencil-square-o"></i> Draft</span>';
                    } elseif ($row->status == 2) {
                        return ' <span class="status_pending"> <i
                        class="fa fa-clock-o"></i> Pending</span>';
                    } elseif ($row->status == 3) {
                        return ' <span class="status_incomming"> <i
                        class="fa fa-arrow-circle-down"></i>
                    Incomming</span>';
                    } elseif ($row->status == 4) {
                        return '<span class="status_production"> <i
                        class="fa fa-industry"></i> 
                    Production</span>';
                    } elseif ($row->status == 5) {
                        return '<span class="status_ready"> <i
                        class="fa fa-check-circle-o"></i> Ready</span>';
                    } elseif ($row->status == 6) {
                        return '<span class="status_pickedup"> <i
                        class="fa fa-hand-paper-o"></i> Picked
                    Up</span>';
                    } elseif ($row->status == 7) {
                        return '<span class="status_delivered"> <i class="fa fa-check" aria-hidden="true"></i>
                        Delivered</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '';

                    $actionBtn .= '<div class="action_button_content">';

                    $actionBtn .= ' <a type="button" href="' . route('order.show', $row->id) . '" title="View" class="btn-view btn-xs"><i
                    class="fa fa-eye"></i> 
                    </a>';




                    $actionBtn .= '<a type="button" href="" title="Change Order Status" class="btn-restore btn-xs"><i
                    class="fa fa-gear"></i> 
                    </a>';

                    $actionBtn .= '<a type="button" title="Move To Trash" id="order_trash" data-id="' . $row->id . '" class="btn-delete btn-xs"><i
                    class="fa fa-trash"></i> 
                    </a>';

                    $actionBtn .= '</div>';

                    return $actionBtn;
                })
                ->addColumn('DT_RowIndex', '')
                ->addColumn('custom_checkbox', function ($row) {
                    return '<input type="checkbox" class="row-checkbox" data-id="' . $row->id . '" name="sub_checkbox" id="sub_checkbox">';
                })

                ->rawColumns(['action', 'status', 'created_at', 'custom_checkbox'])
                ->make(true);
        } else {
            $all_orders = Order::all();
            $all_order_count = Order::count();
            $draft_order_count = Order::where('status', 1)->count();
            return view('admin.order.orderIndex', compact('all_orders', 'all_order_count', 'draft_order_count'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::withTrashed()->with('order_details')->findOrFail($id);
        return view('admin.order.orderView', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function orderTrashed(Request $request)
    {
        $order = Order::findOrFail($request->id);
        $order->delete();
        return response()->json(['status' => 200, 'message' => 'Order Add To Trashed  successfully']);
    }



    public function bulkactionAllOrders(Request $request)
    {
        if ($request->bulk_val == 'trash') {
            $ids = $request->ids;
            Order::whereIn('id', $ids)->delete();
            return response()->json(['status' => 200, 'message' => 'Successfully Orders  Trashed']);
        } elseif ($request->bulk_val == 4) {
            $ids = $request->ids;
            Order::whereIn('id', $ids)->update(['status' => $request->bulk_val]);
            return response()->json(['status' => 200, 'message' => 'Successfully Orders  In Production Mode']);
        } elseif ($request->bulk_val == 5) {
            $ids = $request->ids;
            Order::whereIn('id', $ids)->update(['status' => $request->bulk_val]);
            return response()->json(['status' => 200, 'message' => 'Successfully Orders  Ready Mode']);
        } elseif ($request->bulk_val == 6) {
            $ids = $request->ids;
            Order::whereIn('id', $ids)->update(['status' => $request->bulk_val]);
            return response()->json(['status' => 200, 'message' => 'Successfully Orders  Picked Up Mode']);
        } elseif ($request->bulk_val == 7) {
            $ids = $request->ids;
            Order::whereIn('id', $ids)->update(['status' => $request->bulk_val]);
            return response()->json(['status' => 200, 'message' => 'Successfully Orders  Delivered Mode']);
        } else {
            return response()->json(['status' => 400, 'message' => 'Please Select A Bulk Action']);
        }
    }





    public function getSingleOrder(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        return response()->json($order);
    }

    public function orderStatusChange(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        if ($request->status == 0) {
            $order->status = $request->status;
            $order->save();
            return redirect()->back()->with('message', 'Order process has started successfully');
        } elseif ($request->status == 1) {
            $order->status = $request->status;
            $order->save();
            return redirect()->back()->with('message', 'Order Shipping has started successfully');
        } elseif ($request->status == 2) {
            $order->status = $request->status;
            $order->save();
            return redirect()->back()->with('message', 'Order successfully completed');
        } elseif ($request->status == 3) {
            $order->status = $request->status;
            $order->save();
            return redirect()->back()->with('message', 'Order is now return mode');
        } elseif ($request->status == 4) {
            $order->status = $request->status;
            $order->save();
            return redirect()->back()->with('message', 'Order is cancel');
        }
    }




    public function showTrashed(Request $request)
    {
        if ($request->ajax()) {

            $orders = "";
            $startDate = null;
            $endDate = null;


            $query = Order::query();

            if ($request->has('date_filter_trashed')) {
                $dateFilter = $request->date_filter_trashed;

                switch ($dateFilter) {
                    case 'today':
                        $startDate = Carbon::today();
                        $endDate = Carbon::tomorrow();
                        break;
                    case 'yesterday':
                        $startDate = Carbon::yesterday();
                        $endDate = Carbon::today();
                        break;
                    case 'this_week':
                        $startDate = Carbon::now()->startOfWeek();
                        $endDate = Carbon::now()->endOfWeek();
                        break;
                    case 'last_week':
                        $startDate = Carbon::now()->subWeek()->startOfWeek();
                        $endDate = Carbon::now()->subWeek()->endOfWeek();
                        break;
                    case 'this_month':
                        $startDate = Carbon::now()->month();
                        break;
                    case 'last_month':
                        $startDate = Carbon::now()->subMonth();
                        $endDate = Carbon::now()->month();
                        break;
                    case 'this_year':
                        $startDate = Carbon::now()->startOfYear();
                        $endDate = Carbon::now()->endOfYear();
                        break;
                    case 'last_year':
                        $startDate = Carbon::now()->subYear()->startOfYear();
                        $endDate = Carbon::now()->subYear()->endOfYear();
                        break;
                }
            }





            if ($startDate && $endDate) {
                $query->whereBetween('deleted_at', [$startDate, $endDate]);
            }







            $orders = $query->onlyTrashed()->orderBy('id', 'DESC')->get();






            return DataTables::of($orders)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    $now = Carbon::parse($row->created_at);
                    return $now->toFormattedDateString();
                })
                ->editColumn('status', function ($row) {
                    if ($row->status == 0) {
                        return '<span class="status_processing"> <i
                      class="fa fa-refresh"></i> Processing</span>';
                    } elseif ($row->status == 1) {
                        return '<span class="status_draft"> <i
                      class="fa fa-pencil-square-o"></i> Draft</span>';
                    } elseif ($row->status == 2) {
                        return ' <span class="status_pending"> <i
                        class="fa fa-clock-o"></i> Pending</span>';
                    } elseif ($row->status == 3) {
                        return ' <span class="status_incomming"> <i
                        class="fa fa-arrow-circle-down"></i>
                    Incomming</span>';
                    } elseif ($row->status == 4) {
                        return '<span class="status_production"> <i
                        class="fa fa-industry"></i> 
                    Production</span>';
                    } elseif ($row->status == 5) {
                        return '<span class="status_ready"> <i
                        class="fa fa-check-circle-o"></i> Ready</span>';
                    } elseif ($row->status == 6) {
                        return '<span class="status_pickedup"> <i
                        class="fa fa-hand-paper-o"></i> Picked
                    Up</span>';
                    } elseif ($row->status == 7) {
                        return '<span class="status_delivered"> <i class="fa fa-check" aria-hidden="true"></i>
                        Delivered</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '';

                    $actionBtn .= '<div class="action_button_content">';

                    $actionBtn .= ' <a type="button" href="' . route('order.show', $row->id) . '" title="View" class="btn-view btn-xs"><i
                    class="fa fa-eye"></i> 
                    </a>';




                    $actionBtn .= '<a type="button"  id="restore_order" data-id="' . $row->id . '" title="Order Restore" class="btn-restore btn-xs"><i
                    class="fa fa-undo"></i> 
                    </a>';

                    $actionBtn .= '<a type="button" title="Parmanent Delete" id="parmanent_delete" data-id="' . $row->id . '" class="btn-delete btn-xs"><i
                    class="fa fa-times"></i> 
                    </a>';

                    $actionBtn .= '</div>';

                    return $actionBtn;
                })
                ->addColumn('DT_RowIndex', '')
                ->addColumn('custom_checkbox', function ($row) {
                    return '<input type="checkbox" class="row-checkbox-trash" data-id="' . $row->id . '" name="sub_checkbox" id="sub_checkbox">';
                })

                ->rawColumns(['action', 'status', 'created_at', 'custom_checkbox'])
                ->make(true);
        } else {
            $all_orders = Order::all();
            $all_order_count = Order::count();
            return view('admin.order.orderTrashed', compact('all_orders', 'all_order_count'));
        }
    }


    public function orderRestore(Request $request)
    {
        $order = Order::withTrashed()->findOrFail($request->id);
        $order->restore();
        return response()->json(['status' => 200, 'message' => 'Successfully Order Restore From Trash']);
    }


    public function orderBulkForTrashed(Request $request)
    {
        if ($request->bulk_val == 'delete') {
            $ids = $request->ids;
            Order::whereIn('id', $ids)->forceDelete();
            return response()->json(['status' => 200, 'message' => 'Successfully Orders  Parmanent Delete']);
        } elseif ($request->bulk_val == 'restore') {
            $ids = $request->ids;
            Order::whereIn('id', $ids)->restore();
            return response()->json(['status' => 200, 'message' => 'Successfully Orders  Restore']);
        } else {
            return response()->json(['status' => 400, 'message' => 'Please Select A Bulk Action']);
        }
    }



    public function orderParmanentDelete(Request $request)
    {
        $order = Order::withTrashed()->findOrFail($request->id);
        $order->forceDelete();
        return response()->json(['status' => 200, 'message' => 'Order parmanent delete successfully']);
    }





    //=========all order status tab  related method will be there===============//



    public function allOrderStatusTab (Request $request){
        if($request->ajax()){
            $orders = "";
            $query = Order::query();
            if ($request->status) {
                $query->where('status',$request->status);
            }


            $searchTerm = $request->search;
            if(!empty($request->search)){
                $query->where(function ($subquery) use ($searchTerm) {
                    $subquery->where('order_id', 'like', '%' . $searchTerm . '%')
                        ->orWhere('customer_name', 'like', '%' . $searchTerm . '%');
                });
            }




            $orders = $query->orderBy('id','DESC')->get();






            return DataTables::of($orders)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    $now = Carbon::parse($row->created_at);
                    return $now->toFormattedDateString();
                })
                ->editColumn('status', function ($row) {
                    if ($row->status == 0) {
                        return '<span class="status_processing"> <i
                      class="fa fa-refresh"></i> Processing</span>';
                    } elseif ($row->status == 1) {
                        return '<span class="status_draft"> <i
                      class="fa fa-pencil-square-o"></i> Draft</span>';
                    } elseif ($row->status == 2) {
                        return ' <span class="status_pending"> <i
                        class="fa fa-clock-o"></i> Pending</span>';
                    } elseif ($row->status == 3) {
                        return ' <span class="status_incomming"> <i
                        class="fa fa-arrow-circle-down"></i>
                    Incomming</span>';
                    } elseif ($row->status == 4) {
                        return '<span class="status_production"> <i
                        class="fa fa-industry"></i> 
                    Production</span>';
                    } elseif ($row->status == 5) {
                        return '<span class="status_ready"> <i
                        class="fa fa-check-circle-o"></i> Ready</span>';
                    } elseif ($row->status == 6) {
                        return '<span class="status_pickedup"> <i
                        class="fa fa-hand-paper-o"></i> Picked
                    Up</span>';
                    } elseif ($row->status == 7) {
                        return '<span class="status_delivered"> <i class="fa fa-check" aria-hidden="true"></i>
                        Delivered</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '';

                    $actionBtn .= '<div class="action_button_content">';

                    $actionBtn .= ' <a type="button" href="' . route('order.show', $row->id) . '" title="View" class="btn-view btn-xs"><i
                    class="fa fa-eye"></i> 
                    </a>';




                    $actionBtn .= '<a type="button" href="" title="Change Order Status" class="btn-restore btn-xs"><i
                    class="fa fa-gear"></i> 
                    </a>';

                    $actionBtn .= '<a type="button" title="Move To Trash" id="order_trash" data-id="' . $row->id . '" class="btn-delete btn-xs"><i
                    class="fa fa-trash"></i> 
                    </a>';

                    $actionBtn .= '</div>';

                    return $actionBtn;
                })
                ->addColumn('DT_RowIndex', '')
                ->addColumn('custom_checkbox', function ($row) {
                    return '<input type="checkbox" class="row-checkbox" data-id="' . $row->id . '" name="sub_checkbox" id="sub_checkbox">';
                })

                ->rawColumns(['action', 'status', 'created_at', 'custom_checkbox'])
                ->make(true);
        }else{
            $orders = Order::where('status',$request->status)->get();
            return view('admin.order.orderStatusTab',compact('orders'));
        }
        
    }
    





}
