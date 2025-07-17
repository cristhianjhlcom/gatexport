<x-layouts.public>
  <main>
    <x-homepage.hero :$promotional_banners />
    <x-homepage.about />
    <x-homepage.advantages :advantages="$advantages" />
    <x-homepage.products :categories="$categories" />
    <x-homepage.maps />
  </main>
</x-layouts.public>
