/**
 * Create a icon
 */
export default (name) => {
    const icon = document.createElement('span');
          icon.classList.add('material-icons');
          icon.textContent = name;
          icon.translate = 'no';
    return icon;
}