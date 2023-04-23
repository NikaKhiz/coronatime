<x-layout>
    <x-navigation />
    <div class="px-4 py-6 md:px-24 md:py-10">
        @include('components.statistics._header')
        <div class="mt-6 md:mt-10">
            <form action="">
                <div class="flex gap-2 md:gap-4 py-4 px-6 max-w-[250px] rounded-md border border-gray-300">
                    <img src="{{ asset('images/search.svg') }}" alt="">
                    <input type="text" placeholder="Search By Country" class="w-full outline-none capitalize">
                </div>
            </form>
            <div class="mt-10">
                <table class="w-full text-left">
                    <thead
                        class="text-xs text-black font-semibold capitalize bg-gray-100  p-4 md:px-10 md:py-5 flex w-full">
                        <tr class="flex w-full">
                            <th scope="col" class="flex items-center gap-1 md:gap-2 w-1/4">
                                location
                                <x-statistics.arrows />
                            </th>
                            <th scope="col" class="flex items-center md:gap-2 w-1/4">
                                new cases
                                <x-statistics.arrows />
                            </th>
                            <th scope="col" class="flex items-center gap-1 md:gap-2 w-1/4">
                                deaths
                                <x-statistics.arrows />
                            </th>
                            <th scope="col" class="flex items-center gap-1 md:gap-2 w-1/4">
                                recovered
                                <x-statistics.arrows />
                            </th>
                        </tr>
                    </thead>
                    <tbody
                        class="flex flex-col items-center justify-between overflow-y-scroll w-full max-h-[250px] md:max-h-[450px]">
                        <tr
                            class="flex w-full  border-b-[1px] border-gray-200 text-[14px] text-black font-normal p-4 md:px-10 md:py-5 capitalize">
                            <td class="w-1/4">worldwide</td>
                            <td class="w-1/4">900,000</td>
                            <td class="w-1/4">66000</td>
                            <td class="w-1/4">9000000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
