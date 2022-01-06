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
