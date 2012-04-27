/*
 * Exception raised when trying to lent a
 * book already lent
 * @author M.T. Segarra
 * @version 0.0.1
 */
package exceptions;


public class LentBookException extends Exception {

	public LentBookException(String msg){
		super(msg);
	}

}
