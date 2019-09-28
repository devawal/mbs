## About Mini Bank System(MBS)

The MiniBank online system (MBS) is a small bank for personal and small business. The banking system enables customer to access their bank account and perform their everyday banking needs. MBS has many customers, and each customer has one or more accounts. The MBS use the Euro as currency. The smallest unit of the currency is the single Euro.

## Current modules

- Register:
- Create login:
- Deposit:
- Fund Transfer:
- Check Account balance:

## Installation and Run

1. Run `git clone https://github.com/devawal/mbs.git`
2. Run `composer install` to download dependency
3. Create database `mbs`
4. In this project I used mySQL default credential which is `root` user and `blank` password
5. Upload project database `mbs.sql` from `storage` directory
6. Application login entry point is `http://localhost/mbs/public/auth/user-login`, test user: `ashraf@gmail.com` and password is: `123456` or
7. You can create new account using the link URL: `http://localhost/mbs/public/auth/user-registration` and add balance into account using deposit money `http://localhost/mbs/public/account/deposit`
8. Account deposit has two available options which is Visa and Mastro
9. Please note that this is just a test banking system, actual system will have more validation and steps than current but I am trying to show the procedure of online banking system
10. The project is maintain account `transaction` and `ac_ledger` table to ensure minimal banking procedure
