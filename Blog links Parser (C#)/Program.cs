using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace SeoParser
{
    class Program
    {
        static void Main(string[] args)
        {
            List<Item> items = new List<Item>();

            items.Add(new Item("http://topblogs.su/top/", "topblogs.txt", new TopblogsStrategy()));

            items.Add(new Item("http://www.epochta.ru/rating/cat/seo/", "epochta-seo.txt", new EpochtaStrategy()));           
            items.Add(new Item("http://www.epochta.ru/rating/cat/it/", "epochta-it.txt", new EpochtaStrategy()));
            items.Add(new Item("http://www.epochta.ru/rating/cat/bloging/", "epochta-bloging.txt", new EpochtaStrategy()));
            items.Add(new Item("http://www.epochta.ru/rating/cat/internet/", "epochta-internet.txt", new EpochtaStrategy()));

            items.Add(new Item("http://blograte.ru/category/id/1/", "blograte-seo.txt", new BlograteStrategy()));
            items.Add(new Item("http://blograte.ru/category/id/21/", "blograte-itblogi.txt", new BlograteStrategy()));
            items.Add(new Item("http://blograte.ru/category/id/20/", "blograte-internet.txt", new BlograteStrategy()));
            items.Add(new Item("http://blograte.ru/category/id/15/", "blograte-blogosfera.txt", new BlograteStrategy()));

            items.Add(new Item("http://top.pr-cy.ru/all/", "top.pr-cy.txt", new TopprcyruStrategy()));

            foreach (Item item in items)
                Parser.Parse(item);

            Console.ReadLine();
        }
    }
}
