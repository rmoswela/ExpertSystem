/*initial facts*/

a.									% A is true
b.									% B is true
g.									% G is true
w :- \+a.

%remember assert and retract functions
/*rules*/
%head is true if body is true

e :- c,!.												% C implies E
d :- a,b,c,!.											% A and B and C implies D 
c :- a;b.												% A or B implies C 
f :- a, \+b.											% A and not B implies F
h :- c; \+g,!.											% C and not G implies H
and(X,Y) :- X,Y.										% defining the xor behavior
or(X,Y) :- X;Y.
xor(X,Y) :- or(X,Y), \+and(X,Y).
x :- v xor w,!.											% V xor W implies X
y :- a,b.
z :- a,b.
:- discontiguous (x :- c;d).
v :- c;d.
v :- \+((e,f)).											% E and F implies not V
ifc :- \+((((a,b)) xor (c))).							% A and B if and only if C
ifnc :- ((a,b)) xor (c).								% A and B if and only if not C

test(Name) :- format("~w~n",[Name]).
