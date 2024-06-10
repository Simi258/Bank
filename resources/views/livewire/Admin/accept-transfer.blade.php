
<x-slot name="header">
    <div class="flex justify-between items-center">
        <div class="flex items-center">
            <img src="{{ asset('storage/payment.png') }}" class="h-12 w-12 mr-4">
            <h2 class="text-xl font-semibold text-gray-800">Accept or Decline Transfer</h2>
        </div>
        <a href="{{ route('admin') }}" class="text-sm text-gray-600 underline">Go Back</a>
    </div>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">

                <div class="flex flex-col md:flex-row md:justify-between items-center mb-6">
                    <form method="GET">
                        <div class="flex items-center mb-1">
                            <input name="search" wire:model.live="search" type="search" class="px-2 py-1 border rounded-l-full" placeholder="Search employers...">
                            <button type="submit" class="px-2 py-1 border rounded-r-full bg-indigo-500 text-white">Search</button>
                            <div>
                            </div>
                        </div>
                    </form>

                    <ul class="flex flex-wrap justify-center md:justify-start mb-4">
                        <li class="mr-4">
                            <button class="inline-flex items-center rounded-lg px-3 py-1 text-sm font-semibold {{ $status == '' ? 'bg-slate-300 ' : 'bg-fuchsia-200' }}" wire:click="setStatus('')" wire:model.lazy="status">
                                <svg viewBox="0 0 24 24" width="24" height="24 text-fuchsia-500"   class="h-4 w-4 mr-2 text-fuchsia-500" xmlns="http://www.w3.org/2000/svg" >
                                    <path d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6-1.41-1.41z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                </svg>Show All Transactions
                            </button>
                        </li>
                        <li class="mr-4">
                            <button class="inline-flex items-center rounded-lg px-3 py-1 text-sm font-semibold {{ $status == 'pending' ? 'bg-slate-200 ' : 'bg-yellow-100' }}" wire:click="setStatus('pending')" wire:model.lazy="status">
                                <svg class="animate-spin h-4 w-4 mr-2 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                </svg> Pending Transactions
                            </button>
                        </li>
                        <li class="mr-4 mt-4 md:mt-0">
                            <button class=" inline-flex items-center rounded-lg px-3 py-1 text-sm font-semibold {{ $status == 'accepted' ? 'bg-slate-300 ' : 'bg-green-200'}} hover:bg-green-300" wire:click="setStatus('accepted')" wire:model.lazy="status">
                                <svg class="h-4 w-4 mr-2 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Accepted Transactions
                            </button>
                        </li>
                        <li class="mt-4 md:mt-0">
                            <button class=" inline-flex items-center rounded-lg px-3 py-1 text-sm font-semibold {{$status == 'declined' ? 'bg-slate-400 ' : 'bg-red-400'}} hover:bg-red-500" wire:click="setStatus('declined')" wire:model.lazy="status">
                                <svg class="h-4 w-4 mr-2 text-red-100" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg> Declined Transactions
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="overflow-y-auto" style="height:auto ;">
                    @if(Session::has('deleted'))
                        <div class="alert alert-success text-green-600 mb-2" x-data="{show: true}" x-init="setTimeout(() => show = false, 10000)" x-show="show">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ Session::get('deleted') }}</span>
                        </div>
                    @endif

                    <table class="w-full table-auto text-justify">
                        <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border-b">Name of Sender</th>
                            <th class="px-4 py-2 border-b">Name of Receiver</th>
                            <th class="px-4 py-2 border-b">Sending Amount</th>
                            <th class="px-4 py-2 border-b">Date</th>
                            <th class="px-4 py-2 border-b">Action</th>
                            <th class="px-4 py-2 border-b">Status</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if($status)
                            @foreach($requests as $transaction)
                                @if($transaction->transaction_process == $status)
                                    <tr class="bg-white hover:bg-gray-100">
                                        <td class="px-4 py-2 text-gray-500 border-b">
                                            <p class="font-medium">{{ $transaction->from_name }}</p>
                                        </td>
                                        <td class="px-4 py-2 text-gray-500 border-b">
                                            <p class="font-medium">{{ $transaction->to_name }}</p>
                                        </td>
                                        <td class="px-4 py-2 text-gray-500 border-b">
                                            <p class="font-medium">{{ $transaction->amount }}</p>
                                        </td>
                                        <td class="px-4 py-2 text-gray-500 border-b">
                                            <p class="font-medium">{{ $transaction->created_at->format('d/m/Y h:m a') }}</p>
                                        </td>
                                        <td class="px-4 py-2 text-white border-b">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('admin/see-request/transaction', ['id' => $transaction->id]) }}" class="text-sm bg-blue-500 px-3  hover:bg-blue-800 py-1 rounded-lg">Read</a>
                                                <form wire:submit.prevent="delete({{ $transaction->id }})" wire:confirm="Are you sure you want to delete this message?">
                                                    @csrf
                                                    <button class="text-sm bg-red-400 hover:bg-red-600 text-white px-3 py-1 rounded-lg">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="px-2 py-2 border-b">
                                            <div class=" text-end">
                                                <span class="inline-flex items-center rounded-lg px-3 py-1 text-sm font-semibold
                                                    @if($transaction->transaction_process == 'pending') bg-yellow-100
                                                    @elseif($transaction->transaction_process == 'accepted')bg-green-200
                                                    @elseif($transaction->transaction_process == 'declined')bg-red-400
                                                    @endif">
                                                    @if($transaction->transaction_process == 'pending')
                                          <svg class="animate-spin h-4 w-4 mr-2 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                           </svg>Pending
                                                    @elseif($transaction->transaction_process == 'accepted')
                                           <svg class="h-4 w-4 mr-2 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg> Accepted

                                                    @elseif($transaction->transaction_process == 'declined')
                                            <svg class="h-4 w-4 mr-2 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                                    Declined
                                                    @endif
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach

                        @else
                            @foreach($request as $transactions)
                                <tr class="bg-white hover:bg-gray-100">
                                    <td class="px-4 py-2 text-gray-500 border-b">
                                        <p class="font-medium">{{ $transactions->from_name }}</p>
                                    </td>
                                    <td class="px-4 py-2 text-gray-500 border-b">
                                        <p class="font-medium">{{ $transactions->to_name }}</p>
                                    </td>
                                    <td class="px-4 py-2 text-gray-500 border-b">
                                        <p class="font-medium">{{ $transactions->amount }}</p>
                                    </td>
                                    <td class="px-4 py-2 text-gray-500 border-b">
                                        <p class="font-medium">{{ $transactions->created_at->format('d/m/Y h:m a') }}</p>
                                    </td>
                                    <td class="px-4 py-2 text-white border-b">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin/see-request/transaction', ['id' => $transactions->id]) }}" class="text-sm bg-blue-500 px-3  hover:bg-blue-800 py-1 rounded-lg">Read</a>
                                            <form wire:submit.prevent="delete({{ $transactions->id }})" wire:confirm="Are you sure you want to delete this transactions?" >
                                                @csrf
                                                <button class="text-sm bg-red-400 hover:bg-red-600 text-white px-3 py-1 rounded-lg">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    <td class="px-2 py-2 border-b">
                                        <div class=" text-end">

                     <span class="inline-flex items-center rounded-lg px-3 py-1 text-sm font-semibold
                         @if($transactions->transaction_process == 'pending') bg-yellow-100
                         @elseif($transactions->transaction_process == 'accepted')bg-green-200
                         @elseif($transactions->transaction_process == 'declined')bg-red-400
                          @endif">

                         @if($transactions->transaction_process == 'pending')
                        <svg class="animate-spin h-4 w-4 mr-2 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                             <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        </svg>Pending

                    @elseif($transactions->transaction_process == 'accepted')
                        <svg class="h-4 w-4 mr-2 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                         </svg> Accepted

                    @elseif($transactions->transaction_process == 'declined')
                        <svg class="h-4 w-4 mr-2 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Declined
                     @endif

                         {{--   --}}
                </span>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <div class="mt-4 mb-4 ml-2 mr-2">
                        {{ $request->links() }}
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>
</div>

