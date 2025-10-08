<div class="flex flex-col space-y-4" x-data="{
    open(id) {
        this.openId = this.openId === id ? null : id;
    }
}">
  {{ $slot }}
</div>
