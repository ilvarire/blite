<div class="container">
    <div class="row" wire:ignore>
        <div class="w-full px-[15px]">
            <ul class="nav nav-tabs tabs-style-1 flex flex-wrap mb-[30px] border-b-2 border-[#EAEAEA]">

                <li class="nav-item mr-[3px] mb-[-1px] rounded-ss-md rounded-se-md overflow-hidden">
                    <button class="nav-link border-2 border-transparent px-4 py-2 block active graphic-design-1"
                        href="#graphic-design-1">
                        <i class="icon-image"></i>
                        <span class="hidden md:inline-block ml-[10px]">Additional Information</span>
                    </button>
                </li>
                <li class="nav-item mr-[3px] mb-[-1px] rounded-ss-md rounded-se-md overflow-hidden">
                    <button class="nav-link border-2 border-transparent px-4 py-2 block developement-1"
                        href="#developement-1">
                        <i class="icon-settings"></i>
                        <span class="hidden md:inline-block ml-[10px]">Product Review</span>
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                <div id="graphic-design-1" class="tab-pane duration-500 active">
                    <table class="mb-5 border border-[#00000020] align-middle w-full">
                        <tr>
                            <td class="p-[15px] font-medium text-bodycolor border border-[#00000020] ">Rating
                            </td>
                            <td class="p-[15px] font-medium text-yellow border border-[#00000020] ">
                                <span class="rating-bx">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i
                                            class="fas fa-star {{ $food->averageRating() >= $i ? 'text-yellow' : 'text-bodycolor' }}"></i>
                                    @endfor
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-[15px] font-medium text-bodycolor border border-[#00000020] ">
                                Estimated prepare time
                            </td>
                            <td class="p-[15px] font-medium text-bodycolor border border-[#00000020] ">
                                3hrs
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="developement-1" class="tab-pane duration-500" style="display: none;">
                    <div class="comments-area" id="comments">
                        <ul class="comment-list md:mb-[60px] mb-10">
                            @forelse ($reviews as $review)
                                <li class="comment">
                                    <div
                                        class="comment-body relative min-h-[95px] border-b border-[#2222221a] md:pl-[100px] pl-[75px] md:pb-[30px] pb-[15px] md:mb-[30px] mb-5">
                                        <div class="comment-author vcard">
                                            <img class="md:h-[80px] h-[60px] md:w-[80px] w-[60px] rounded-full left-0 absolute"
                                                src="/user.png" alt="/">
                                            <cite class="not-italic text-base font-semibold mb-2 block">
                                                {{$review->user->name}}
                                            </cite>
                                        </div>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i
                                                class="fas fa-star {{ $review->rating >= $i ? 'text-yellow' : 'text-bodycolor' }}"></i>
                                        @endfor
                                        <p>
                                            {{ $review->comment }}
                                        </p>
                                    </div>
                                    <!-- list END -->
                                </li>
                            @empty
                                <p class="text-xl text-bodycolor">No reviews yet</p>
                            @endforelse
                        </ul>
                    </div>
                    @if ($canReview)
                        <div class="comment-respond style-1" id="respond">
                            <h3 class="widget-title xl:mb-[30px] mb-5 pb-3 relative text-2xl" id="reply-title">Add a
                                review</h3>
                            <form class="flex flex-wrap mx-[-10px]" wire:submit.prevent="submitReview" id="commentform"
                                method="post">
                                <div class="comment-form-rating flex text-bodycolor px-[10px]">
                                    <label class="pull-left mr-[10px] mb-5">Your Rating</label>
                                    <div class="rating-widget">
                                        <!-- Rating Stars Box -->
                                        <div class="rating-stars">
                                            <ul id="stars" class="flex space-x-1">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <li class="star inline-block cursor-pointer"
                                                        :class="{'text-yellow': @this.rating >= {{ $i }}, 'text-gray-400': @this.rating < {{ $i }}}"
                                                        wire:click="$set('rating', {{ $i }})" data-value="{{ $i }}">
                                                        <i class="fas fa-star fa-fw text-sm"></i>
                                                    </li>
                                                @endfor
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <p class="comment-form-comment mb-5 px-[10px] w-full">
                                    <label class="hidden" for="message">Comment</label>
                                    <textarea rows="10" wire:model="message" placeholder="Type Review Here" id="message"
                                        class="resize-none h-[120px] py-[15px] bg-[#f3f4f6] px-5 w-full text-[15px] rounded-[6px] placeholder:text-[#666666] border-2 border-[#f3f4f6] focus:border-primary focus:bg-white duration-500"></textarea>
                                </p>
                                <p class="form-submit mb-5 px-[10px] w-full">
                                    <button type="submit" wire:click="submitReview"
                                        class="btn btn-primary btn-hover-2">Submit
                                        Now</button>
                                </p>
                                @if (session()->has('message'))
                                    <div class="mt-4 text-green-500">
                                        {{ session('message') }}
                                    </div>
                                @endif
                            </form>

                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>