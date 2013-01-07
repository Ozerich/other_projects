using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Text.RegularExpressions;

namespace SeoParser
{
    class TopprcyruStrategy : IStrategy
    {
        public List<string> Parse(string url)
        {
            List<string> result = new List<string>();

            for (int page = 1; ; page++)
            {
                string text = Http.Download(url + page.ToString());

                int currentPage = Int32.Parse(Regex.Match(text, @"<strong>(\d+)</strong>", RegexOptions.IgnoreCase).Groups[1].Value);

                if (currentPage != page)
                {
                    break;
                }

                foreach (Match match in Regex.Matches(text, "<li>(?:.|\n)+?<a href=\"(?<1>[^\"]*)\"", RegexOptions.IgnoreCase))
                {
                    result.Add(match.Groups[1].Value);
                }

            }

            return result;  
        }
    }
}
