import IAddress from "./IAddress";
import IBook from "./IBook";

export default interface IOrder {
    id: number,
    user_id: number,
    book_id: number,
    address_id: number,
    book: IBook,
    created_at: string,
    address: IAddress
}