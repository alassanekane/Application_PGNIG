/*
 * Class representing a book of a library
 * @author M.T. Segarra
 * @version 0.0.1
 */
package booksManagement;


import java.util.*;

import exceptions.*;
import loansManagement.Loan;

import javax.persistence.*;

/**
 * Entity implementation class for Entity: Book
 *
 */
@Entity
@Table(name="books")
@NamedQuery(name="findAllBooks", query="select b from Book b")
public class Book  {

	/**
	 * @uml.property name="title"
	 */
	@Column (name="book_title")
	private String title;

	/**
	 * Getter of the property <tt>title</tt>
	 * 
	 * @return Returns the title.
	 * @uml.property name="title"
	 */
	public String getTitle() {
		return title;
	}

	/**
	 * Setter of the property <tt>title</tt>
	 * 
	 * @param title
	 *            The title to set.
	 * @uml.property name="title"
	 */
	public void setTitle(String title) {
		this.title = title;
	}

	/**
	 * @uml.property name="authors"
	 */
	@Transient
	private ArrayList<String> authors;

	/**
	 * Getter of the property <tt>authors</tt>
	 * 
	 * @return Returns the authors.
	 * @uml.property name="authors"
	 */
	public ArrayList<String> getAuthors() {
		return authors;
	}

	/**
	 * Setter of the property <tt>authors</tt>
	 * 
	 * @param authors
	 *            The authors to set.
	 * @uml.property name="authors"
	 */
	public void setAuthors(ArrayList<String> authors) {
		this.authors = authors;
	}

	/**
	 * @uml.property name="editionDate"
	 */
	private Calendar editionDate;

	/**
	 * Getter of the property <tt>editionDate</tt>
	 * 
	 * @return Returns the editionDate.
	 * @uml.property name="editionDate"
	 */
	public Calendar getEditionDate() {
		return editionDate;
	}

	/**
	 * Setter of the property <tt>editionDate</tt>
	 * 
	 * @param editionDate
	 *            The editionDate to set.
	 * @uml.property name="editionDate"
	 */
	public void setEditionDate(Calendar editionDate) {
		this.editionDate = editionDate;
	}

	/**
	 * @uml.property name="isbn"
	 */
	@Id
	@Column (name="isbn_id")
	private String isbn;

	/**
	 * Getter of the property <tt>isbn</tt>
	 * 
	 * @return Returns the isbn.
	 * @uml.property name="isbn"
	 */
	public String getIsbn() {
		return isbn;
	}

	/*
	 * Two books are equal if their ISBN is the same
	 */
	@Override
	public boolean equals(Object book) {
		if (book == null)
			return false;
		Book b = (Book) book;

		if (b.isbn == isbn)
			return true;

		return false;
	}

	public Book(){};
	
	/**
	 * Creates a book All parameters should be given
	 * 
	 * @param title
	 *            the title of the book
	 * @param authors
	 *            the list of the authors (names)
	 * @param editionDate
	 *            date of the edition of the book
	 * @param isbn
	 *            ISBN of the book
	 * @throws BadParametersException
	 */
	public Book(String title, ArrayList<String> authors, Calendar editionDate,
			java.lang.String isbn) throws BadParametersException {
		if ((title == null) || (authors == null) || (editionDate == null)
				|| (isbn == null))
			throw new BadParametersException();

		this.title = title;
		this.authors = authors;
		this.editionDate = editionDate;
		this.isbn = isbn;
	}

	/**
	 * Setter of the property <tt>isbn</tt>
	 * 
	 * @param isbn
	 *            The isbn to set.
	 * @uml.property name="isbn"
	 */
	public void setIsbn(String isbn) {
		this.isbn = isbn;
	}

	/**
	 * @uml.property name="loan"
	 * @uml.associationEnd inverse="book:loansManagement.Loan"
	 */
	@Transient
	private Loan loan;

	/**
	 * Getter of the property <tt>loan</tt>
	 * 
	 * @return Returns the loan.
	 * @uml.property name="loan"
	 */
	public Loan getLoan() {
		return loan;
	}

	/**
	 * Setter of the property <tt>loan</tt>
	 * 
	 * @param loan
	 *            The loan to set.
	 * @uml.property name="loan"
	 */
	public void setLoan(Loan loan) {
		this.loan = loan;
	}

	/**
	 * @return true if this book is lent
	 */
	public boolean isLent() {
		return (loan != null);
	}

	/**
	 * Makes actions to return a book No test if the return date is lower than
	 * today
	 * 
	 * @throws LentBookException
	 * @throws BadParametersException
	 */
	public void returnBook() throws LentBookException, BadParametersException {

		if (!isLent())
			throw new LentBookException("The book is not lent");

		loan.returnBook();

		this.loan = null;
	}

	/**
	 * @throws LentBookException
	 */
	public void lend(Loan loan) throws LentBookException {
		// Check if the book is available
		if (this.isLent())
			throw new LentBookException("Book already lent.");

		this.loan = loan;
	}

	/**
	 * Returns a description of the book
		 */
	public String toString() {
		return this.title + ", " + this.isbn;
	}


}