<x-app-layout>
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
                <div class="overflow-y-auto" style="height:auto ;">
                    <table class="w-full table-auto text-justify">
                        <thead>
                        @csrf
                        <td class=" px-4 py-2 border-b text-lg sm:text-s">Current Balance:</td>
                        <td class=" px-4 py-2 border-b"></td>
                        <td class=" px-4 py-2 border-b"></td>
                        <td class=" px-4 py-2 border-b"></td>
                        <td class=" px-4 py-2 border-b"></td>
                        <td class=" px-4 py-2 border-b text-lg">{{ __( $accounts->bank_balance)."€"}}   </td>
                        <tr>
                            <th class="px-4 py-2">Title</th>
                            <th class="px-4 py-2">Sender</th>
                            <th class="px-4 py-2">Receiver</th>
                            <th class="px-4 py-2">Transaction Type</th>
                            <th class="px-4 py-2">Date</th>
                            <th class="px-4 py-2">Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td  class="px-4 py-2 border-b">
                                    <a href="{{ route('transaction.show.transaction', $transaction->id) }}"
                                       class="text-blue-500 hover:text-blue-800">
                                        {{ $transaction->transaction_title }}
                                </td>
                                <td class="px-4 py-2 text-gray-500 border-b">{{ $transaction->to_iban}}</td>
                                <td class="px-4 py-2  text-gray-500 border-b">{{ $transaction->from_iban}}</td>
                                <td class="px-4 py-2 border-b
                                <?php echo ($transaction->transaction_type == 'credit') ? 'text-green-800' : ''; ?>
                                <?php echo($transaction->transaction_type == 'debit') ? 'text-red-800' : '' ; ?>"
                                >{{ $transaction->transaction_type }}</td>
                                <td class="px-4 py-2 border-b">{{ $transaction->created_at->format('m.d.Y h:i A') }}</td>
                                <td class="px-4 py-2 border-b
                                <?php echo  ($transaction->transaction_type == 'credit') ?  'text-green-800' : ''; ?>
                                <?php echo ($transaction->transaction_type == 'debit')? 'text-red-500' : '' ;?>">
                                <span <?php echo ($transaction->transaction_type == 'debit') ? 'class="text-red-800"' : ''; ?>>
                                {{ ($transaction->transaction_type == 'debit') ? '-' : '+' }}{{ $transaction->amount."€" }}</span></td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
                <hr>
            </div>
        </div>
    </div>
</div>
</x-app-layout>

