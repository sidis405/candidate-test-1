<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Tag;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('orders.index')->withOrders(Order::paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('orders.create')
            ->withOrder(new Order)
            ->withCustomers(Customer::all())
            ->withTags(Tag::all());
    }

    /**
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    private function validateRequest(Request $request): void
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'cost' => 'required|numeric|between:0,99999999.99',
            'customer_id' => 'required',
            'tags' => 'array',
        ]);
    }

    /**
     * Either creates or updates an order
     *
     * @param Request $request
     * @param Order|null $order
     * @return Order|null
     */
    private function saveOrder(Request $request, Order $order = null): ?Order
    {
        DB::beginTransaction();
        try {
            if ($order === null) {
                $order = Order::create($request->all());
                // Create associated contract
                $data = ['customer_id' => $request->input('customer_id')];
                $order->contract()->create($data);
            } else {
                $order->update($request->all());
            }
            $order->tags()->sync($request->input('tags'));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return null;
        }
        return $order;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validateRequest($request);
        $order = $this->saveOrder($request);
        if (empty($order)) {
            return redirect()->back()->withMessage('Something went wrong');
        }
        return redirect()->route('orders.edit', $order)->withMessage('Order created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Order $order
     * @return View
     */
    public function show(Order $order): View
    {
        return view('orders.view');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Order $order
     * @return View
     */
    public function edit(Order $order)
    {
        $orderTagIds = $order->tags->pluck('id')->toArray();
        return view('orders.edit', compact('order', 'orderTagIds'))
            ->withCustomers(Customer::all())
            ->withTags(Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Order $order
     * @return RedirectResponse
     */
    public function update(Request $request, Order $order): RedirectResponse
    {
        $this->validateRequest($request);
        $order = $this->saveOrder($request, $order);
        if (empty($order)) {
            return redirect()->back()->withMessage('Something went wrong');
        }
        return redirect()->route('orders.edit', $order)->withMessage('Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return RedirectResponse
     */
    public function destroy(Order $order): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $order->delete();
            $order->contract()->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withMessage('Something went wrong');
        }

        return redirect()->route('orders.index')->withMessage('Order deleted successfully');
    }
}
