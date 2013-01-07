using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Text.RegularExpressions;

namespace SeoParser
{
    class BlograteStrategy : IStrategy
    {
        public List<string> Parse(string url)
        {
            List<string> result = new List<string>();

            for (int page = 0; ; page++)
            {
                string text = Http.Download(url + "page/" + page + "/");

                var currentPageMatch = Regex.Match(text, "class=\"current\">(?<1>(.|\n)+?)</a>", RegexOptions.IgnoreCase);
                int currentPage = currentPageMatch.Length > 0 ? Int32.Parse(currentPageMatch.Groups[1].Value.Trim()) : 1;

                if (currentPage - 1 != page)
                {
                    break;
                }

                foreach(Match match in Regex.Matches(text, "<strong>(.|\n)+?href=\"(?<1>.+?)\"", RegexOptions.IgnoreCase))
                {
                    result.Add(match.Groups[1].Value);
                }
            }
            return result;
        }
    }
}
