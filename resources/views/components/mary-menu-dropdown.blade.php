<li x-data="{
            show:  false ,
            toggle(){
                // From parent Sidebar
                if (this.collapsed) {
                    this.show = true
                    $dispatch('menu-sub-clicked');
                    return
                }

                this.show = !this.show
            }
        }">

    <details :open="show" @click.stop="">
        <summary @click.prevent="toggle()" class="hover:text-inherit text-inherit rounded-md whitespace-nowrap flex">
            <span class="block -mt-0.5 flex-shrink-0">
                <img src="{{ $image }}" alt="{{ $title }}" class="inline w-7 h-7 min-w-[1.5rem] min-h-[1.5rem]">
            </span>
            <span class="mary-hideable whitespace-nowrap truncate">
                {{ $title }}
            </span>
        </summary>
        <ul class="mary-hideable">
            {{ $slot }}
        </ul>
    </details>
</li>