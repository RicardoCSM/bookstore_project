import IAuthor from "./IAuthor";

export default interface IBook {
    id: number,
    isbn_13: string,
    num_pages: number,
    name: string,
    price: string,
    publication_date: string,
    publisher_id: number,
    publisher: {name: string},
    authors: IAuthor[]
}