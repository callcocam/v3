export function toggleCode(e) {
  const card = e.target.closest(".card");
  const codeWrapper = card.querySelector(".code-wrapper");

  e.target.checked
    ? codeWrapper.classList.remove("hidden")
    : codeWrapper.classList.add("hidden");
}

export function getBrwoserScrollbarWidth() {
  return window.innerWidth - document.documentElement.clientWidth;
}

export function documentMask(input) {
  console.log( input.length)
  return input.length <= 14
      ? '999.999.999-99'
      : '99.999.999/9999-99'//18.120.621/0001-74
}