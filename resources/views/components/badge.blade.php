<span @class(['ml-1 badge',
              'badge-red' => $red ?? false,
              'badge-yellow' => $orange ?? false,
              'badge-green' => $green ?? false,
              'badge-gray' => $gray ?? false])
>
    @if($triangle ?? false) <i class="fa-solid fa-triangle-exclamation mr-1"></i> @endif
    {{ $text }}
</span>
