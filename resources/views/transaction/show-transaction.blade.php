<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col lg:flex-row items-center lg:justify-between ">
            <div class="flex items-center">
                <div class="rounded-full p-1">
                    <h1 class="text-2xl font-bold">Transaction Detail:</h1>
                </div>
                <div>
                    <p class="text-2xl font-medium pl-2"> {{$transaction->transaction_title}}</p>
                </div>
            </div>
            <div class="flex mt-4 lg:mt-0">
                <div class="flex items-center">
                    <a href="{{ route('transaction.transaction', ['id' => $transaction->accounts_id]) }}" class="text-sm text-gray-600 underline">
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
                    <h2 class="order-last mt-2 text-slate-400">{{ $transaction->created_at->format('d/m/Y h:i: a') }}</h2>
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
{{----}}
