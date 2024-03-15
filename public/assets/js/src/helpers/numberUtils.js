export const numberFormat = (number, locale='en-US', style='currency', currency='USD') => {
    return new Intl.NumberFormat(
        locale, {
            style: style,
            currency: currency
        }
    ).format(number)
}

export default {
    numberFormat: numberFormat,
}