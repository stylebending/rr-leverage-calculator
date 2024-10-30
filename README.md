# RR and Leverage Calculator

### This is a singple page app to calculate the risk to reward (RR) of a trade and the leverage to be used for a trade. 

Trading journals are great and they are a crucial part of trading to reflect and keep track of your trades. However it seems all trading journals lack a final total RR calculator and they also lack a leverage calculator. That is why I've built this tool. 

### Some useful notes:
- **The RR tool is meant to be used for winning trades only**, since you should have predetermined the RR of losing trades in advance.
- This tool has a slider option to include the fees, that you're going to pay to the exchange, in the calculations. **These fees are 0.07% of your positions size on nearly all exchanges, that's why the calculation including fees multiplies with 0.93 (100% - 7% = 93%).**
- This tool is written to be used by Dutch users, so there might be some Dutch words used for the button text or the error messages for example, but **if you just follow the code and the comments in the code (which are written in English), it's easy to figure out.**

This tool should be used on a server with PHP installed, so any shared hosting will do, even a PHP development server will do.
If you have PHP installed locally on your machine, you can start a PHP development server locally by going to the project directory in your terminal, for example:

`cd /var/www/rr-leverage-calculator`

Then run the following command to start the PHP development server:

`php -S localhost:8000`

The tool is accesible now in your browser at url:

`localhost:8000`

Enjoy!