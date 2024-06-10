    <x-slot name="header">
        <div class="flex flex-col lg:flex-row items-center lg:justify-between ">
            <div class="flex items-center">
                <div class="rounded-full p-1">
                    <h1 class="text-2xl font-bold">Transaction-Details:</h1>
                </div>
                <div>
                    <p class="text-2xl font-medium pl-2"> {{$transaction->transaction_title}}</p>
                </div>
            </div>
            <div class="flex mt-4 lg:mt-0">
                <div class="flex items-center">
                    <a href="{{ route('transaction-show', ['id' => $transaction->accounts_id]) }}" class="text-sm text-gray-600 underline">
                        Go Back
                    </a>
                </div>
            </div>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border rounded-lg overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 pb-12 border-b-4 <?php echo ($transaction->transaction_type == 'debit')? 'border-red-400' : ''; ?>
                                            <?php echo ($transaction->transaction_type == 'credit')? 'border-green-400' : '';?>">
                    <div class=" flex justify-between">
                        <h2 class="text-2xl font-bold ">Transaction Details</h2>
                        <h2 class="order-last mt-2 text-slate-400">{{ $transaction->created_at->format('d/m/Y h:i a') }}</h2>
                    </div>
                    <h2 class="mt-4 text-lg font-semibold">Sender:</h2>
                    <p class="border-b text-m text-gray-500">{{$transaction->from_iban}}</p>

                    <h2 class="mt-4 text-lg font-semibold">Receiver:</h2>
                    <p class="border-b text-m text-gray-500">{{$transaction->to_iban}}</p>
                    <h2 class=" mt-4 text-lg font-semibold">Description:</h2>
                    <p class="border-b text-m text-gray-500">{{ $transaction->transaction_description }}</p>
                    <div class="flex mt-4">
                        <h2 class="text-2xl pr-2  font-bold">Amount:</h2>
                        <h2 class=" text-2xl font-bold
                                <?php echo  ($transaction->transaction_type == 'credit') ?  'text-green-800' : ''; ?>
                                <?php echo ($transaction->transaction_type == 'debit')? 'text-red-500' : '' ;?>">
                                <span class="text-2xl mt-2 font-bold
                                <?php echo ($transaction->transaction_type == 'debit') ? 'class="text-red-800"' : ''; ?>">
                                {{ ($transaction->transaction_type == 'debit') ? '-' : '+' }}{{ $transaction->amount."€" }}</span></h2>
                    </div>
                    <div class=" text-end">
                <span
                    class="inline-flex items-center rounded-lg px-3 py-1 text-sm font-semibold
                    @if($transaction->transaction_process == 'pending') bg-yellow-100 @elseif($transaction->transaction_process == 'accepted')bg-green-200
                    @elseif($transaction->transaction_process == 'declined')bg-red-400 @endif">
                 @if($transaction->transaction_process == 'pending')
                        <svg class="animate-spin h-4 w-4 mr-2 text-yellow-500" xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                 </svg>Pending
                    @elseif($transaction->transaction_process == 'accepted')
                        <svg class="h-4 w-4 mr-2 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg> Accepted
                    @elseif($transaction->transaction_process == 'declined')
                        <svg class="h-4 w-4 mr-2 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                        Declined
                    @endif
                </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
