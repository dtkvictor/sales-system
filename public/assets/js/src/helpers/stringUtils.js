/**
 * Format value to slug
 * @param string value
 * @example This Is Your Value => this-is-return-value;
 */
export const toSlug = (value) => {
    value = value.toLowerCase();
    value = value.replace(/^\s+|\s+$/g, '');
    value = value.replace(/[^\w\s-]/g, '');
    value = value.replace(/\s+/g, '-');
    return value;
}

/**
 * String format phone number pt_BR
 * @param string phoneNumber 
 * @return string
 * @exemple This phoneNumber: 99123451234 => (99) 12345-1234
 */

export const toPhoneNumber = (phoneNumber) => {
    phoneNumber = phoneNumber.toString();
    phoneNumber = phoneNumber.replace(/[^\d()\s-]/g, '');

    const pattern = /^\(?(\d{2})?\)?\s?(\d{5})?\-?(\d{4})?$/;
    return phoneNumber.replace(pattern, (match, p1, p2, p3) => {
        let phoneNumberFormat = '';
        if(p1) phoneNumberFormat += '('+ p1 + ') ';
        if(p2) phoneNumberFormat += p2 + '-';
        if(p3) phoneNumberFormat += p3;
        return phoneNumberFormat;
    });
}

/**
 * String format cpf
 * @param string cpf 
 * @return string
 * @exemple This cpf: 12312312300 => 123.123.123-00
 */

export const toCPF = (cpf) => {
    cpf = cpf.toString();
    cpf = cpf.replace(/[^\d.-]/g, '');

    const pattern = /^(\d{3})?\.?(\d{3})?\.?(\d{3})?\-?(\d{2})?$/;
    return cpf.replace(pattern, (match, p1, p2, p3, p4) => {
        let cpfFormatNumber = '';
        if(p1) cpfFormatNumber += p1 + '.';
        if(p2) cpfFormatNumber += p2 + '.';
        if(p3) cpfFormatNumber += p3 + '-';
        if(p4) cpfFormatNumber += p4;
        return cpfFormatNumber;
    });
}

/**
 * Remove special character the string numeric.
 * @param string value
 * @return string
 * @example This string numeric: (99) 12345-1234 => 99123451234
 */
export const toNumber = (value) => {
    value.toString();
    return value.replace(/[^0-9]/g, '');
}

/**
 * @return string
 */
export const generateUniqueId = () => {
    const timestamp = Date.now().toString(36);
    const randomChars = Math.random().toString(36).substr(2, 5);
    return timestamp + randomChars;
}

export default {
    toSlug: toSlug,
    toPhoneNumber: toPhoneNumber,
    toNumber: toNumber,
    toCPF: toCPF,
    generateUniqueId: generateUniqueId
}