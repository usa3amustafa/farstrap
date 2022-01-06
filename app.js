'use strict'

const customize = document.querySelector('.customize')
const customizeDropdown = document.querySelector('.customize-dropdown')
const collection = document.querySelector('.collection')
const collectionDropdown = document.querySelector('.collection-dropdown')

customize.addEventListener('click', () => {
  customizeDropdown.classList.toggle('show')
  collectionDropdown.classList.remove('show')
})
collection.addEventListener('click', () => {
  customizeDropdown.classList.remove('show')

  collectionDropdown.classList.toggle('show')
})

const counterText = document.querySelector('.counter')
const decrease = document.querySelector('.btn-decrease')
const increase = document.querySelector('.btn-increase')

let counterNumber = 0

const resetFunction = function () {
  counterNumber = 0
  //   counterText.className = ''
  counterText.textContent = counterNumber
}

const decreaseFunction = function () {
  counterNumber > 0 ? counterNumber-- : 0
  counterText.textContent = counterNumber
}

const increaseFunction = function () {
  counterNumber++
  counterText.textContent = counterNumber
}

resetFunction()

decrease.addEventListener('click', decreaseFunction)
increase.addEventListener('click', increaseFunction)
