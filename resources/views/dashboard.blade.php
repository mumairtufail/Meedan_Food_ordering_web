<x-app-layout>
    <x-slot name="header">
        Dashboard
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- Stats Cards -->
        <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm flex flex-col"> 
             <div class="text-xs text-gray-500 font-medium uppercase mb-1 tracking-wide">Total Users</div>
             <div class="text-2xl font-bold text-gray-900">1,234</div>
             <div class="text-xs text-green-600 mt-2 flex items-center font-medium">
                 <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                 12% Increase
             </div>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm flex flex-col"> 
             <div class="text-xs text-gray-500 font-medium uppercase mb-1 tracking-wide">Active Restaurants</div>
             <div class="text-2xl font-bold text-gray-900">56</div>
             <div class="text-xs text-green-600 mt-2 flex items-center font-medium">
                 <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                 5% Increase
             </div>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm flex flex-col"> 
             <div class="text-xs text-gray-500 font-medium uppercase mb-1 tracking-wide">Pending Orders</div>
             <div class="text-2xl font-bold text-gray-900">23</div>
             <div class="text-xs text-amber-600 mt-2 flex items-center font-medium">
                 Attention needed
             </div>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm flex flex-col"> 
             <div class="text-xs text-gray-500 font-medium uppercase mb-1 tracking-wide">Total Revenue</div>
             <div class="text-2xl font-bold text-gray-900">$12,450</div>
             <div class="text-xs text-green-600 mt-2 flex items-center font-medium">
                 <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                 8% Increase
             </div>
        </div>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-gray-50/50">
             <h3 class="text-sm font-bold uppercase tracking-wide text-gray-700">Recent Orders</h3>
             <a href="#" class="text-xs font-semibold text-primary hover:text-primary/80 uppercase tracking-wide">View All &rarr;</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-primary">#ORD-001</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">John Doe</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2.5 py-0.5 inline-flex text-xs leading-4 font-semibold rounded-full bg-green-100 text-green-800 border border-green-200">
                                Delivered
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">$45.00</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2 mins ago</td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-primary">#ORD-002</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Jane Smith</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2.5 py-0.5 inline-flex text-xs leading-4 font-semibold rounded-full bg-amber-100 text-amber-800 border border-amber-200">
                                Preparing
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">$28.50</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15 mins ago</td>
                    </tr>
                     <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-primary">#ORD-003</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Mike Johnson</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2.5 py-0.5 inline-flex text-xs leading-4 font-semibold rounded-full bg-blue-100 text-blue-800 border border-blue-200">
                                Out for Delivery
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">$62.00</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">35 mins ago</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>