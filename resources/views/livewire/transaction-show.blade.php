<x-slot name="header">
        <div class="flex flex-col lg:flex-row items-center lg:justify-between ">
            <div class="flex items-center">
                <div class="bg-gray-200 rounded-full p-1">
                    <img src="{{ asset('storage/lending.png') }}"  alt="transaction"  class="h-12 w-12 mr-4">
                </div>
                <h1 class="text-xl font-semibold text-gray-800">Transactions</h1>
            </div>
            <div class="flex mt-4 lg:mt-0">
                <div class="flex items-center">
                    <a href="{{ route('dashboard', ['id' => $accounts->account_id]) }}" class="text-sm text-gray-600 underline">
                        Go Back
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col md:flex-row md:justify-between items-center mb-6">
                        <ul class="flex flex-wrap justify-center md:justify-start mb-4">
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
                        <table class="w-full table-auto text-center">
                            <thead class="bg-gray-100">
                            @csrf
                            <td class=" px-4 py-2 border-b text-lg">Current Balance:</td>
                            <td class=" px-4 py-2 border-b"></td>
                            <td class=" px-4 py-2 border-b"></td>
                            <td class=" px-4 py-2 border-b"></td>
                            <td class=" px-4 py-2 border-b"></td>
                            <td class=" px-4 py-2 border-b"></td>
                            <td class=" px-4 py-2 border-b text-lg">{{ __( $accounts->bank_balance)."€"}}   </td>
                            <tr>
                                <th class="px-4 py-2">Title</th>
                                <th class="px-4 py-2">Receiver</th>
                                <th class="px-4 py-2">Sender</th>
                                <th class="px-4 py-2">Transaction Type</th>
                                <th class="px-4 py-2">Process</th>
                                <th class="px-4 py-2">Date</th>
                                <th class="px-4 py-2">Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($status)
                                @foreach ($transactions as $transaction)
                                    @if($transaction->transaction_process == $status)
                                        <tr class="{{ $transaction->created_at->diffInHours($now) <= 2
                                    ? ($transaction->transaction_type == 'credit' ? 'bg-green-100' : 'bg-red-100')
                                    : '' }}">                                    <td  class="px-4 py-2 border-b">
                                        <a href="{{ route('transaction-info', $transaction->id) }}"
                                           class="text-blue-500 hover:text-blue-800">
                                        {{ $transaction->transaction_title }}
                                    </td>
                                    <td class="px-4 py-2 text-gray-500 border-b">{{ $transaction->to_iban}}</td>
                                    <td class="px-4 py-2  text-gray-500 border-b">{{ $transaction->from_iban}}</td>
                                    <td class="px-4 py-2 border-b
                                <?php echo ($transaction->transaction_type == 'credit') ? 'text-green-800' : ''; ?>
                                <?php echo($transaction->transaction_type == 'debit') ? 'text-red-800' : '' ; ?>"
                                    >{{ $transaction->transaction_type }}</td>
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
                                    <td class="px-4 py-2 border-b">{{ $transaction->created_at->format('d.m.Y') }}</td>
                                    <td class="px-4 py-2 border-b
                                <?php echo  ($transaction->transaction_type == 'credit') ?  'text-green-800' : ''; ?>
                                <?php echo ($transaction->transaction_type == 'debit')? 'text-red-500' : '' ;?>">
                                <span <?php echo ($transaction->transaction_type == 'debit') ? 'class="text-red-800"' : ''; ?>>
                                {{ ($transaction->transaction_type == 'debit') ? '-' : '+' }}{{ $transaction->amount."€" }}</span></td>
                                </tr>
                                    @endif
                                @endforeach

                            @else
                                @foreach($transactions as $transaction)
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
                                                <form wire:submit.prevent="delete({{ $transaction->id }})" wire:confirm="Are you sure you want to delete this transactions?" >
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
                        </span>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>


