<x-slot name="header">
    <div class="flex flex-col lg:flex-row items-center lg:justify-between ">
        <div class="flex items-center">
            <div class="rounded-full p-1">
                <h1 class="text-2xl font-bold">Transaction Request:</h1>

            </div>
            <div>
                <p class="text-xl font-medium pt-1 text-gray-500 text-clip"> {{ Str::words($request->reason,2) }}</p>

            </div>
        </div>
        <div class="flex mt-4 lg:mt-0">
            <div class="flex items-center ">
                <a href="{{ route('admin/accept-transfer') }}" class="text-sm text-gray-600 underline ">
                    Go Back
                </a>
            </div>
        </div>
    </div>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white border rounded-lg overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 pb-12 border-b-4 <?php echo ($request->transaction_process == 'pending')? 'border-amber-400' : ''; ?>
                                             <?php echo ($request->transaction_process == 'accepted')? 'border-green-400' : '';?>
                                             <?php echo ($request->transaction_process == 'declined')? 'border-red-400': '' ;?>">
                <div class=" flex justify-between">
                    <h2 class="text-2xl font-bold ">Transaction Details</h2>
                    <h2 class="order-last mt-2 text-slate-400">{{ $request->created_at->format('d/m/Y h:i: a') }}</h2>
                </div>
                <h2 class="mt-4 text-lg font-semibold">Sender:</h2>
                <p class="border-b text-m text-gray-500">{{$request->from_iban}}</p>
                <h2 class="mt-4 text-lg font-semibold">Receiver:</h2>
                <p class="border-b text-m text-gray-500">{{$request->to_iban}}</p>
                <h2 class=" mt-4 text-lg font-semibold">Description:</h2>
                <p class="border-b text-m text-gray-500">{{ $request->transaction_description }}</p>
                <div class="flex mt-4">
                    <h2 class="text-2xl pr-2  font-bold">Amount:</h2>
                    <h2 class=" text-2xl font-bold
                        <?php echo  ($request->transaction_process == 'pending') ?  'text-yellow-500' : ''; ?>
                        <?php echo ($request->transaction_process == 'accepted')? 'text-green-500' : '' ;?>
                        <?php echo ($request->transaction_process == 'declined')? 'text-red-500' : '' ;?>">
                        <span class="text-2xl mt-2 font-bold
                                <?php echo ($request->transaction_process == 'credit') ? 'class="text-green-500"' : ''; ?>">
                                {{ ($request->transaction_process == 'debit') ? '-' : '+' }}{{ $request->amount."€" }}
                                </span>
                    </h2>
                </div>
                <div class=" text-end">
                <span
                    class="inline-flex items-center rounded-lg px-3 py-1 text-sm font-semibold
                    @if($request->transaction_process == 'pending') bg-yellow-100 @elseif($request->transaction_process == 'accepted')bg-green-200
                    @elseif($request->transaction_process == 'declined')bg-red-400 @endif">
                 @if($request->transaction_process == 'pending')
                        <svg class="animate-spin h-4 w-4 mr-2 text-yellow-500" xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                 </svg>Pending
                    @elseif($request->transaction_process == 'accepted')
                        <svg class="h-4 w-4 mr-2 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg> Accepted
                    @elseif($request->transaction_process == 'declined')
                        <svg class="h-4 w-4 mr-2 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                        Declined
                    @endif
                </span>
                </div>
            </div>
            @if(session('error'))
                <div class="alert alert-danger text-red-700 ml-2 mt-2 font-semibold" x-data="{show: true}" x-init="setTimeout(() => show = false, 6000)" x-show="show">
                    <ul>
                        <li>{{ session('error') }}</li>
                    </ul>
                </div>
            @endif
            @if(Session::has('success'))
                <div class="alert alert-success text-green-700 ml-2 mt-2" x-data="{show: true}" x-init="setTimeout(() => show = false, 6000)" x-show="show">
                    <strong>{{ Session::get('success') }}</strong>
                </div>
            @endif
            @if ($transactionProcess->transaction_process !== 'pending')
                <div class="text-center text-gray-500 m-3 ">
                    This transaction request has already been processed.
                </div>
            @else
                <div class="flex justify-center my-4">
                    <button wire:click="accept" wire:comfirm="Are you sure you want to accept the transaction" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Accept
                    </button>
                    <button wire:click="decline" wire:confirm="Are you sure you want to decline the transaction " class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">
                        Decline
                    </button>
                    <button wire:click="putOnHold" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded ml-2">
                        Put on Hold
                    </button>
                </div>
            @endif

        </div>
    </div>
</div>
