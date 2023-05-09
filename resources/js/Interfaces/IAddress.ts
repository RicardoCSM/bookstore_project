export default interface IAddress {
    id: number,
    user_id: number,
    identification: string,
    street_name: string,
    street_number: number | string,
    zip_code: number | string,
    complement: string
}