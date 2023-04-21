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
                                <div class="flex flex-col gap-1">
                                    <svg width="10" height="6" viewBox="0 0 10 6" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5 0.5L10 5.5L0 5.5L5 0.5Z" fill="#BFC0C4" />
                                    </svg>
                                    <svg width="10" height="6" viewBox="0 0 10 6" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5 5.5L1.90735e-06 0.5H10L5 5.5Z" fill="#BFC0C4" />
                                    </svg>
                                </div>
                            </th>
                            <th scope="col" class="flex items-center md:gap-2 w-1/4">
                                new cases
                                <div class="flex flex-col gap-1">
                                    <svg width="10" height="6" viewBox="0 0 10 6" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5 0.5L10 5.5L0 5.5L5 0.5Z" fill="#BFC0C4" />
                                    </svg>
                                    <svg width="10" height="6" viewBox="0 0 10 6" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5 5.5L1.90735e-06 0.5H10L5 5.5Z" fill="#BFC0C4" />
                                    </svg>
                                </div>
                            </th>
                            <th scope="col" class="flex items-center gap-1 md:gap-2 w-1/4">
                                deaths
                                <div class="flex flex-col gap-1">
                                    <svg width="10" height="6" viewBox="0 0 10 6" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5 0.5L10 5.5L0 5.5L5 0.5Z" fill="#BFC0C4" />
                                    </svg>
                                    <svg width="10" height="6" viewBox="0 0 10 6" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5 5.5L1.90735e-06 0.5H10L5 5.5Z" fill="#BFC0C4" />
                                    </svg>
                                </div>
                            </th>
                            <th scope="col" class="flex items-center gap-1 md:gap-2 w-1/4">
                                recovered
                                <div class="flex flex-col gap-1">
                                    <svg width="10" height="6" viewBox="0 0 10 6" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5 0.5L10 5.5L0 5.5L5 0.5Z" fill="#BFC0C4" />
                                    </svg>
                                    <svg width="10" height="6" viewBox="0 0 10 6" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5 5.5L1.90735e-06 0.5H10L5 5.5Z" fill="#BFC0C4" />
                                    </svg>
                                </div>
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
