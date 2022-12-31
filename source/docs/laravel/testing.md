---
title: Testing
description:
extends: _layouts.documentation
section: content
updatedAt: 2022-12-31
---
- ✋ Always write unit and integration tests, testing for success and failure for each scenario.
- 🤔 Only test public methods of classes.
- ✋ Write tests so that they cover all protected and private methods of the class, accessed through the public methods. If there are non-public methods that are not covered, they are either inaccessible, or the tests are comprehensive enough. If they are inaccessible, those methods should be removed.
- ✋ Tests should document the functionality of classes and their methods.
- ✋ Mock any external interfaces you do not control, and test for both successes and failures.
- ✋ Do not mock classes that you control.

## Databases
Do not use SQLite for testing if:
  - you are using JSON fields
  - require exact float value calculations based on decimal fields
  - have table alterations in your migrations
  - if you have raw queries which manipulate dates

## Unit Tests

- ✋ Write unite tests before implementing classes (only implement classes, never procedural code).
- ✋ When starting an app, start where you would start with writing code. The first test does not have to be elegant, or even correct. The most important thing is just to get started.
- ✋ Always do Red/Green/Refactor TDD. This means writing tests for the code you would like to see in an optimal world. Then make the failing test pass using the minimum amount of code. Write another test to expand on the first test, which again makes the existing code fail. Refactor your code to make the second test pass. Rinse and repeat until you have the minimum necessary functionality for your MVP (minimum viable product).
- ✋ During the red/green/refactor process, keep in mind that you need to develop from two different perspectives:
    1. When writing tests, keep the larger picture of the application and business domain in mind.
    1. When writing code to satisfy tests, only think about the test that needs to be satisfied. DO NOT THINK ABOUT BUSINESS LOGIC, ONLY FOCUS ON MAKING TESTS GREEN.
- ✋ Never add code that wont be used.
- ✋ Remove any code that is not used.
- ✋ Use cyclomatic complexity as a guide for the number of tests needed to achieve full test coverage of your code.
- ✋ As your tests get more specific, your code should become more generic.
- ✋ Goal of tests is to get as quickly as possible to &quot;Shameless Green&quot;, which means that no matter how ugly your code is, it satisfies all tests, thus is &quot;green&quot;.
- ✋ One of the principles of Shameless Green is that code is written for understanding, rather than extreme adherence to any and all patterns. The human is the focus.
- ✋ Consider Robert Martin&#39;s Transformation Priority Premise ([https://8thlight.com/blog/uncle-bob/2013/05/27/TheTransformationPriorityPremise.html](https://8thlight.com/blog/uncle-bob/2013/05/27/TheTransformationPriorityPremise.html)) when writing functional code to keep code complexity at a minimum. Try to opt for the highest ranked option.
- ✋ Abstract logic into methods only if they are used multiple times. Otherwise this might introduce mental debt and increase code complexity.
- ✋ Consider waiting to dry out duplicated code until after a few tests cover it. This way the correct abstraction might reveal itself, rather than prematurely abstracting it out incorrectly.
