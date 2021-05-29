# point-of-sale scanning API
 by Andrew Liu
For coding test


## instruction

Used strategy design pattern to calculate the price.


### Why use strategy design pattern?
 1.GetFreeFirstStrategy -> Consider the buy 1 get 1 free first when calculate the total price </br>
 2.VolumeSaleFirstStrategy -> Consider the volume sale first when calculate the total price </br>

#### case 1:
A    |$2.0 each or 4 for $7.0</br>
B    |$10.0 buy 1 B get 1 A free</br>

scan("AAAAABB") -> 5As 2Bs</br>

 1.GetFreeFirstStrategy -> the total price = (2 * 3 + 10 * 2) *(1 + tax) = 26 * 1.1 = 28.6</br>
 2.VolumeSaleFirstStrategy -> the total price = (7 + 10 * 2) * (1 + tax) = 27 * 1.1 = 29.7</br>
 So, in this case, the correct total price is 28.6(GetFreeFirstStrategy)</br>

#### case 2:
A    |$1.0 each or 6 for $5.0</br>
B    |$10.0 buy 1 B get 1 A free</br>

scan("AAAAAAABB") -> 7As 2Bs</br>

 1.GetFreeFirstStrategy -> the total price = (1 * 5 + 10 * 2) *(1 + tax) = 25 * 1.1 = 27.5</br>
 2.VolumeSaleFirstStrategy -> the total price = (5 + 10 * 2) * (1 + tax) = 25 * 1.1 = 27.5</br>
 So, in this case, the correct total price is 27.5(both these 2 strategies right)</br>

#### case 3:
A    |$1.0 each or 7 for $5.0</br>
B    |$2.0 buy 1 B get 1 A free</br>

scan("AAAAAAAABB") -> 8As 2Bs</br>

 1.GetFreeFirstStrategy -> the total price = (1 * 6 + 10 * 2) *(1 + tax) = 26 * 1.1 = 28.6</br>
 2.VolumeSaleFirstStrategy -> the total price = (5 + 10 * 2) * (1 + tax) = 25 * 1.1 = 27.5</br>
 So, in this case, the correct total price is 27.5(VolumeSaleFirstStrategy)</br>

### 1.style of this API

![image](https://github.com/fengliu1227/point-of-sale-php/blob/master/layout.png)
When the application starts, it will print the main with price.


```bash
Product Code | Price
A                        |$2.0 each or 4 for $7.0
B                        |$10.0 each
C                        |$1.25 each or 6 for $6.0
D                        |$0.15 each or 4 for $7.0
E                        |$2.0 each AND if buy one B get one E
Please enter 'continue' to continue with current pricing or 'set' to add new pricing
Please enter 'exit' to exit this program

```

### 2.Continuing with exiting pricing

input the product code in a single stream, and then click check out. The result will show in pink color.



before enter 'r', you can scan as much as you want to the cart.


if the cart is empty, it will return 0.

if you entered unexist product code(it will throw an Exception)

the checkout will not success when the stock is not enough


### 3. update a price

This api allow user to update the unitprice, volunme size, volunme price and stock quatity.

It could be complete after inputing in the certain input feild and click update.

If the input if vaild, it will not affect the execution.



## test case all passed.
Scan these items in this order: ABCDABAA; Verify the total price is $31.24.

Scan these items in this order: CCCCCC; Verify the total price is $6.6.

Scan these items in this order: ABCD; Verify the total price is $14.74.

Scan these items in this order: ABCDE; Verify the total price is $14.74.

Scan these items in this order: ACDE; Verify the total price is $5.94. 

