# RR and Leverage Calculator

### This is a singple page app to calculate the risk to reward (RR) of a trade and the leverage to be used for a trade. 

Trading journals are great and they are a crucial part of trading to reflect and keep track of your trades. However it seems all trading journals lack a final total RR calculator and they also lack a leverage calculator. That is why I've built this tool. 

### Some useful notes:
- **This tool has an option to include the fees (turned on by default), that you're going to pay to the exchange. If you're trading with leverage, these fees are 0.07% of your positions size on nearly all exchanges. This is why the calculations including fees adds 0.07 to the stop loss percentage.**
- **This tool is written to be used by Dutch users, so there might be some Dutch words used for the labels or the error messages for example, but if you just follow the code and the comments in the code, which are written in English, it's easy to figure out.**

This tool can be used on a server with PHP installed, so any shared hosting will do, even a PHP development server will do.
If you have PHP installed on your machine, you can start a local PHP development server by going to the project directory in your terminal, for example:

`cd /var/www/rr-leverage-calculator`

Then run the following command to start the PHP development server:

`php -S localhost:8000`

The tool is accesible now in your browser at url:

`localhost:8000`

Enjoy!