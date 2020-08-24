export default class MapboxStyleSwitcherControl {
  constructor(styleOptions) {
    this.mapStyles = styleOptions
    this.onDocumentClick = this.onDocumentClick.bind(this)
  }

  getDefaultPosition() {
    const defaultPosition = 'top-right'

    return defaultPosition
  }

  onAdd(map) {
    this.map = map
    this.mapStyleContainer = document.createElement('div')
    this.controlContainer = document.createElement('div')
    this.styleButton = document.createElement('button')

    this.mapStyleContainer.classList.add('mapboxgl-style-list')
    this.controlContainer.classList.add('mapboxgl-ctrl', 'mapboxgl-ctrl-group')

    for (const [styleName, styleUri] of Object.entries(this.mapStyles)) {
      const styleElement = document.createElement('button')
      styleElement.innerText = styleName
      styleElement.dataset.uri = JSON.stringify(styleUri)
      styleElement.classList.add(styleName.replace(/[^a-z0-9-]/gi, '_'))

      styleElement.addEventListener('click', event => {
        const srcElement = event.srcElement
        const elms = this.mapStyleContainer.getElementsByClassName('active')

        this.map.setStyle(JSON.parse(srcElement.dataset.uri))
        this.mapStyleContainer.style.display = 'none'
        this.styleButton.style.display = 'block'

        while (elms[0]) {
          elms[0].classList.remove('active')
        }

        srcElement.classList.add('active')
      })

      if (styleName === this.mapStyles[0]) styleElement.classList.add('active')

      this.mapStyleContainer.appendChild(styleElement)
    }

    this.styleButton.classList.add('mapboxgl-ctrl-icon', 'mapboxgl-style-switcher')

    this.styleButton.addEventListener('click', () => {
      this.styleButton.style.display = 'none'
      this.mapStyleContainer.style.display = 'block'
    })

    document.addEventListener('click', this.onDocumentClick)
    this.controlContainer.appendChild(this.styleButton)
    this.controlContainer.appendChild(this.mapStyleContainer)

    return this.controlContainer
  }

  onRemove() {
    if (!this.controlContainer || !this.controlContainer.parentNode || !this.map || !this.styleButton) return

    this.styleButton.removeEventListener('click', this.onDocumentClick)
    this.controlContainer.parentNode.removeChild(this.controlContainer)
    document.removeEventListener('click', this.onDocumentClick)
    this.map = undefined
  }

  onDocumentClick(event) {
    if (this.controlContainer && !this.controlContainer.contains(event.target) && this.mapStyleContainer && this.styleButton) {
      this.mapStyleContainer.style.display = 'none'
      this.styleButton.style.display = 'block'
    }
  }
}
