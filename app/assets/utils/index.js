export function formatPrice(price) {
    return price.toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2})
}