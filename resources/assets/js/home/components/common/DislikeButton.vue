<template>
  <button @click="$emit('click')" type="button" class="hearth-button">
    <svg width="253" height="253" viewBox="0 0 253 253" fill="none" xmlns="http://www.w3.org/2000/svg">
      <g clip-path="url(#clip0)">
        <path d="M37.4541 164.303C20.488 148.931 7.90373 128.777 2.55025 106.098C-1.38137 89.4456 0.404811 80.1959 0.404811 80.1959C3.71405 42.9341 30.0362 11.6684 66.5846 11.6684C89.4052 11.6684 108.436 23.6555 119.993 41.8563L119.892 41.7905L82.2756 96.9496L155.58 106.726L97.9363 159.567L140.678 186.279L122.331 241.327L37.4541 164.303ZM250.45 106.108C245.096 128.787 232.512 148.936 215.546 164.308L134.596 236.53L152.797 181.922L114.579 158.034L178.375 99.5555L99.8844 89.0965L127.016 49.3046C127.274 49.1174 127.522 48.9049 127.684 48.5811C138.72 26.651 160.878 11.6734 186.41 11.6734C222.959 11.6734 249.281 42.9392 252.59 80.201C252.595 80.201 254.381 89.4557 250.45 106.108Z" fill="#E4C15B"/>
      </g>
      <defs>
        <clipPath id="clip0">
          <rect width="253" height="253" fill="white"/>
        </clipPath>
      </defs>
    </svg>
  </button>
</template>

<script>
export default {
}
</script>

<style lang="scss" scoped>

.hearth-button {
  transition: opacity 0.3s ease;
  opacity: 0;
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  margin: auto;
  width: 195px;
  height: 160px;
  background: transparent;
  border: 0;
  svg {
    width: 100%;
  }
}
@media(max-width:768px) {
  .hearth-button {
    width:100px;
  }
}

</style>
